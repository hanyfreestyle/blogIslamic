<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

trait CategoryTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryIndex
    public function CategoryIndex($id = null) {
        if (!$this->TableCategory) {
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $trees = [];

        if ($this->categoryTree) {
            if (Route::currentRouteName() == $this->PrefixRoute . '.index_Main') {
                $rowData = self::getSelectQuery($this->model->def()->where('parent_id', null));
            } elseif (Route::currentRouteName() == $this->PrefixRoute . '.SubCategory') {
                $rowData = self::getSelectQuery($this->model->def()->where('parent_id', $id));
                $trees = $this->model->find($id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();
                $pageData['SubView'] = true;
            } else {
                $rowData = self::getSelectQuery($this->model->def());
            }
        } else {
            $rowData = self::getSelectQuery($this->model->def());
        }

        return view('admin.mainView.category.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'trees' => $trees,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryCreate
    public function CategoryCreate() {
        if (!$this->TableCategory) {
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $LangAdd = self::getAddLangForAdd();

        $rowData = $this->model->findOrNew(0);

        return view('admin.mainView.category.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'LangAdd' => $LangAdd,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryEdit
    public function CategoryEdit($id) {
        if (!$this->TableCategory) {
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->model->findOrFail($id);
        $LangAdd = self::getAddLangForEdit($rowData);
        return view('admin.mainView.category.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'LangAdd' => $LangAdd,
        ]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   SetCatTree
    public function SetCatTree($categoryTree, $deep) {
        if ($categoryTree) {
            if (Route::currentRouteName() == $this->PrefixRoute . '.edit') {
                $thisId = intval(Route::current()->parameter('id'));
                $catChildren = $this->model->find($thisId)->descendantsAndSelf()->pluck('id')->toArray();
                $this->Categories = $this->model::tree($deep)->with('translations')->whereNotIn('id', $catChildren)->get()->toTree();
            } else {
                $this->Categories = $this->model::tree($deep)->get()->toTree();
            }
        } else {
            $this->Categories = [];
        }
        View::share('Categories', $this->Categories);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TraitsCategoryStoreUpdate($request, $id) {

        if (intval($id) == 0) {
            $saveData = $this->model->findOrNew($id);
        } else {
            $saveData = $this->model->findOrFail($id);
            if ($this->categoryTree == true) {
                $trees = $this->model->find($saveData->id)->descendants()->pluck('id')->toArray();
                if (in_array($request->input('parent_id'), $trees)) {
                    return back()->with('data_not_save', "");
                }
            }
        }

        try {
            DB::transaction(function () use ($request, $saveData) {


                if ($this->categoryTree == true) {
                    if ($request->input('parent_id') != 0 and $request->input('parent_id') != $saveData->id) {
                        $saveData->parent_id = $request->input('parent_id');
                        $saveData->deep = count($this->model->find($request->input('parent_id'))->ancestorsAndSelf()->pluck('id')->toArray());
                    }
                }
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->save();

                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');

                if ($this->categoryIcon) {
                    $saveImgData_icon = new PuzzleUploadProcess();
                    $saveImgData_icon->setUploadDirIs($this->UploadDirIs . '/' . $saveData->id);
                    $saveImgData_icon->setnewFileName($request->input('en.slug'));
                    $saveImgData_icon->setfileUploadName('icon');
                    $saveImgData_icon->UploadOne($request, "IconFilter");
                    $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData_icon, 'icon');
                    $saveData->save();
                }

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $dbName = $this->translationdb;
                    $saveTranslation = $this->translation->where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$dbName = $saveData->id;
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }

                if ($this->categoryTree) {
                    if ($saveData->is_active == false) {
                        $trees = $this->model->find($saveData->id)->descendants()->pluck('id')->toArray();
                        if (count($trees) > 0) {
                            $this->model->whereIn("id", $trees)->update(['is_active' => 0]);
                        }
                    }
                }

            });

        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySort
    public function CategorySort($id) {
        if (!$this->categorySort) {
            abort(403);
        }

        $pageData = $this->pageData;

        $pageData['ViewType'] = "List";
        $thisRow = null;
        if ($id == 0) {
            $rowData = $this->model->where('parent_id', null)->orderBy('postion')->get();
        } else {
            $thisRow = $this->model->findOrFail($id);
            $rowData = $this->model->where('parent_id', $thisRow->id)->orderBy('postion')->get();;
        }

        return view('admin.mainView.category.sort', compact('pageData', 'rowData', 'thisRow'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySaveSort
    public function CategorySaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = $this->model->findOrFail($id);
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

}
