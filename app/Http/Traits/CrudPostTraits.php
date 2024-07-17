<?php

namespace App\Http\Traits;


use App\Helpers\AdminHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

trait CrudPostTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function PostIndex() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = $this->model::onlyTrashed()->count();

        if ($this->viewDataTable and $this->yajraTable) {
            return view('admin.mainView.post.index_DataTable', compact('pageData'));
        } else {
            $rowData = self::getSelectQuery($this->model::def());
            return view('admin.mainView.post.index', compact('pageData', 'rowData'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function PostSoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $pageData['SubView'] = false;
        View::share('yajraTable', false);
        $rowData = self::getSelectQuery($this->model::onlyTrashed());
        return view('admin.mainView.post.index', compact('pageData', 'rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SubCategory
    public function PostListCategory($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = true;
        $Category = $this->modelCategory::findOrFail($id);
        $rowData = self::getSelectQuery($this->model::def()->whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        }));
        return view('admin.mainView.post.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PostCreate
    public function PostCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        if ($this->TableCategory) {
            $Categories = $this->modelCategory::all();
        } else {
            $Categories = [];
        }
        $rowData = $this->model::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];

        if ($this->TableTags) {
            $tags = $this->modelTags::where('id', '!=', 0)->take(100)->get();
            $selTags = [];
        } else {
            $tags = [];
            $selTags = [];
        }

        return view('admin.mainView.post.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PostEdit
    public function PostEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        if ($this->TableCategory) {
            $rowData = $this->model::where('id', $id)->with('categories')->firstOrFail();
            $Categories = $this->modelCategory::all();
            $selCat = $rowData->categories()->pluck('category_id')->toArray();
        } else {
            $rowData = $this->model::where('id', $id)->firstOrFail();
            $Categories = [];
            $selCat = [];
        }

        $LangAdd = self::getAddLangForEdit($rowData);

        if ($this->TableTags) {
            $selTags = $rowData->tags()->pluck('tag_id')->toArray();
            $tags = $this->modelTags::whereIn('id', $selTags)->take(50)->get();
        } else {
            $tags = [];
            $selTags = [];
        }

        return view('admin.mainView.post.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TraitsPostStoreUpdate($request, $id) {
        $saveData = $this->model::findOrNew($id);

        $categories = $request->input('categories');
        $tags = $request->input('tag_id');
        $user_id = Auth::user()->id;

        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->youtube = $request->input('youtube');

        if ($this->postPublishedDate) {
            $saveData->published_at = SaveDateFormat($request, 'published_at');
        }
        if ($request->input('form_type') == 'Add' and  $this->TableReview ) {
            $saveData->user_id = $user_id;
        }
        if ($this->postAddBrand) {
            $saveData->brand_id = $request->input('brand_id');
        }

        $saveData->save();

        if ($request->input('form_type') == 'Edit' and $this->TableReview ) {
            $blogReview = $this->modelReview ;
            $blogReview->user_id = $user_id;
            $blogReview->blog_id = $saveData->id;
            $blogReview->updated_at = now();
            $blogReview->save();
        }

        if ($this->TableCategory) {
            $saveData->categories()->sync($categories);
        }
        if ($this->TableTags) {
            $saveData->tags()->sync($tags);
        }

        self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'ar.name');

        $addLang = json_decode($request->add_lang);
        foreach ($addLang as $key => $lang) {
            $CatId = $this->DbPostCatId;
            $saveTranslation = $this->translation->where($CatId, $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->$CatId = $saveData->id;
            $saveTranslation->youtube_title = $request->input($key . '.youtube_title');
            $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
            $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
            $saveTranslation->save();
        }

        try {
            DB::transaction(function () use ($request, $saveData) {


            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }
}
