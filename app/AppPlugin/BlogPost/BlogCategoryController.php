<?php

namespace App\AppPlugin\BlogPost;

use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogCategoryTranslation;
use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefCategoryRequest;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class BlogCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits;
    use BlogConfigTraits;

    function __construct(BlogCategory $model, BlogCategoryTranslation $translation) {
        parent::__construct();
        $this->controllerName = "BlogCategory";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $this->UploadDirIs = 'blog-category';
        $this->translation = $translation;
        $this->translationdb = 'category_id';

        $Config = $this->LoadConfig();
        View::share('Config', $Config);

        if ($Config['TableCategory']) {
            self::SetCatTree($Config['categoryTree'], $Config['categoryDeep']);
        }


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => [
                "editor" => $Config['categoryEditor'],
                'iconfilterid' => $Config['categoryIcon'],
                'labelView' => 0,
                'filterid' => $Config['categoryPhotoAdd'],
                'selectfilterid' => $Config['categoryPhotoAdd'],
            ],

            'yajraTable' => false,
            'AddLang' => true,
        ];

        self::loadConstructData($sendArr);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashSideBlogCategories');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryStoreUpdate
    public function CategoryStoreUpdate(DefCategoryRequest $request, $id = 0) {
        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id) {
        if ($this->categoryDelete == false) {
            abort(403);
        }

        $deleteRow = BlogCategory::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_blog')
            ->firstOrFail();

        if ($deleteRow->del_category_count == 0 and $deleteRow->del_blog_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'CategoryBlog', 'deleteRow' => $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'CategoryBlog', 'deleteRow' => $deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $Config = self::DbConfig();

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Blog";
        $mainMenu->name = "admin/blogPost.app_menu";
        $mainMenu->icon = "fab fa-blogger";
        $mainMenu->roleView = "Blog_view";
        $mainMenu->save();

        if ($Config['TableCategory']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("BlogCategory");
            $subMenu->url = "admin.Blog.BlogCategory.index";
            $subMenu->name = "admin/blogPost.app_menu_category";
            $subMenu->roleView = "Blog_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BlogPost.create";
        $subMenu->url = "admin.Blog.BlogPost.create";
        $subMenu->name = "admin/blogPost.app_menu_add_blog";
        $subMenu->roleView = "Blog_view";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BlogPost.index|BlogPost.edit|BlogPost.editEn|BlogPost.editAr";
        $subMenu->url = "admin.Blog.BlogPost.index";
        $subMenu->name = "admin/blogPost.app_menu_blog";
        $subMenu->roleView = "Blog_view";
        $subMenu->icon = "fas fa-rss";
        $subMenu->save();


        if ($Config['TableTags']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "BlogTags.index|BlogTags.edit|BlogTags.create|BlogTags.config";
            $subMenu->url = "admin.Blog.BlogTags.index";
            $subMenu->name = "admin/blogPost.app_menu_tags";
            $subMenu->roleView = "Blog_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }

    }

}
