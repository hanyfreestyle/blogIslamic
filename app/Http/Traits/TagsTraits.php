<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

trait TagsTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('ss');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsIndex
    public function TagsIndex() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        return view('admin.mainView.tags.index', compact('pageData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function TagsDataTable(Request $request) {
        if ($request->ajax()) {
            $data = self::TagsindexQuery($this->DbTags, $this->DbTagsTrans);
            return self::TagsDataTableColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsCreate
    public function TagsCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = $this->tags::findOrNew(0);
        return view('admin.mainView.tags.form')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsEdit
    public function TagsEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->tags::where('id', $id)->firstOrFail();
        return view('admin.mainView.tags.form')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TraitsTagsStoreUpdate
    public function TraitsTagsStoreUpdate($request, $id) {
        $saveData = $this->tags::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));

                $saveData->save();
                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = $this->tagsTranslation::where('tag_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->tag_id = $saveData->id;
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsDelete
    public function TagsDelete($id) {
        $deleteRow = $this->tags::where('id', $id)->firstOrFail();
        try {
            DB::transaction(function () use ($deleteRow, $id) {
                $deleteRow->forceDelete();
            });
        } catch (\Exception $exception) {
            return back()->with(['confirmException' => '', 'fromModel' => 'Attribute', 'deleteRow' => $deleteRow]);
        }
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsConfig
    public function TagsConfig() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        return view("admin.mainView.config", compact('pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   TagsSearch
    public function TagsSearch(Request $request) {
        if (!empty($_GET['type']) && $_GET['type'] == 'TagsSearch') {
            $search = $request->search;
            $tags = $this->tagsTranslation::orderby('name', 'asc')
                ->select('id', 'name', 'tag_id')
                ->where('locale', thisCurrentLocale())
                ->where('name', 'like', '%' . $search . '%')
                ->limit(50)->get();
            $response = array();
            foreach ($tags as $tag) {
                $response[] = array("id" => $tag->tag_id, "text" => $tag->name);
            }
            return response()->json($response);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # TagsOnFly
    public function TagsOnFly(Request $request) {
        $response = array('addDone' => false);
        if ($request->newTagData['newTag'] == true) {
            $slug = AdminHelper::Url_Slug($request->newTagData['text']);
            $slugCount = $this->tagsTranslation::where('slug', $slug)->count();
            if ($slugCount == 0) {
                $addNewTag = $this->tags;
                $addNewTag->save();
                foreach (config('app.web_lang') as $key => $lang) {
                    $newTranslation = $this->tagsTranslation::where('id', 0)->firstOrNew();
                    $newTranslation->tag_id = $addNewTag->id;
                    $newTranslation->locale = $key;
                    $newTranslation->slug = $slug;
                    $newTranslation->name = $request->newTagData['text'];
                    $newTranslation->save();
                }
                $response = array('addDone' => true, 'id' => $addNewTag->id);
            }
        }
        return response()->json($response);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    public function TagsindexQuery($table, $table_trans) {

        $data = DB::table($table)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.tag_id')
            ->where($table_trans . '.locale', '=', DefModelConfigTraits::defLangStatic())
            ->select("$table.id as id",
                "$table.is_active as is_active",
                "$table_trans.name",
            );
        return $data;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function TagsDataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('is_active', function ($row) {
                return is_active($row->is_active);
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'is_active']);
    }

}
