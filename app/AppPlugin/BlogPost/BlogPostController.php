<?php

namespace App\AppPlugin\BlogPost;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogPhoto;
use App\AppPlugin\BlogPost\Models\BlogPhotoTranslation;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefPostRequest;
use App\Http\Traits\CrudPostTraits;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class BlogPostController extends AdminMainController {

    use CrudTraits;
    use CrudPostTraits;
    use BlogConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogPost";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_blog');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $this->model = new Blog();
        $this->translation = new BlogTranslation();
        $this->modelCategory = new BlogCategory();
        $this->modelPhoto = new BlogPhoto();
        $this->photoTranslation = new BlogPhotoTranslation();
        $this->modelTags = new BlogTags();
        $this->modelReview = new BlogReview();

        $this->modelPhotoColumn = 'blog_id';
        $this->UploadDirIs = 'blog';
        $this->translationdb = 'blog_id';

        $this->PrefixTags = "admin.BlogPost";
        View::share('PrefixTags', $this->PrefixTags);

        $Config = self::LoadConfig();
        View::share('Config', $Config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => $Config['postEditor'], 'morePhotoFilterid' => $Config['TableMorePhotos']],
            'yajraTable' => true,
            'AddLang' => true,
            'AddMorePhoto' => true,
            'restore' => 1,
        ];

        self::loadConstructData($sendArr);

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $this->CashBrandList = self::CashBrandList($this->StopeCash);
            View::share('CashBrandList', $this->CashBrandList);
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashSidePopularTags');
        Cache::forget('CashSideBlogCategories');
        Cache::forget('CashBrandMenuList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PostCreate
    public function PostCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Categories = $this->modelCategory::all();
        $tags = $this->modelTags::where('id', '!=', 0)->take(100)->get();
        $selTags = [];
        $rowData = $this->model::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];

        return view('AppPlugin.BlogPost.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
            'selActive' => 1,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PostEdit
    public function PostEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $rowData = $this->model::where('id', $id)->with('categories')->firstOrFail();
        $Categories = $this->modelCategory::all();
        $selCat = $rowData->categories()->pluck('category_id')->toArray();
        $LangAdd = self::getAddLangForEdit($rowData);
        $selTags = $rowData->tags()->pluck('tag_id')->toArray();
        $tags = $this->modelTags::whereIn('id', $selTags)->take(50)->get();


        return view('AppPlugin.BlogPost.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
            'selActive' => $rowData->is_active,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   PostDataTable
    public function PostDataTable(Request $request) {
        if ($request->ajax()) {
            $data = $this->model::select(['blog_post.id', 'photo_thum_1', 'is_active', 'published_at'])->with('tablename');
            return self::DataTableAddColumns($data)->make(true);
        }
    }





#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function PostStoreUpdate(DefPostRequest $request, $id = 0) {
        return self::TraitsPostStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function PostForceDeleteException($id) {
        $deleteRow = $this->model::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
        if (count($deleteRow->more_photos) > 0) {
            foreach ($deleteRow->more_photos as $del_photo) {
                AdminHelper::DeleteAllPhotos($del_photo);
            }
        }
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        AdminHelper::DeleteDir($this->UploadDirIs, $id);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


}
