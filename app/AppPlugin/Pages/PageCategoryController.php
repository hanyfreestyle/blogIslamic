<?php

namespace App\AppPlugin\Pages;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Pages\Models\PageCategory;
use App\AppPlugin\Pages\Models\PageCategoryTranslation;
use App\AppPlugin\Pages\Traits\PageConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefCategoryRequest;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class PageCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits;
    use PageConfigTraits;

    function __construct(PageCategory $model, PageCategoryTranslation $translation) {

        parent::__construct();
        $this->controllerName = "PageCategory";
        $this->PrefixRole = 'Pages';
        $this->selMenu = "admin.Pages.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/pages.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $this->UploadDirIs = 'pages-cat';
        $this->translation = $translation;
        $this->translationdb = 'category_id';


        $this->Config = self::LoadConfig();

        if ($this->TableCategory) {
            self::SetCatTree($this->Config['categoryTree'], $this->Config['categoryDeep']);
        }
        View::share('Config', $this->Config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => [
                "editor" => $this->categoryEditor,
                'iconfilterid' => $this->categoryIcon,
                'filterid' => $this->categoryPhotoAdd,

            ],
            'yajraTable' => false,
            'AddLang' => true,
        ];

        self::loadConstructData($sendArr);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashProductPageInfo');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryStoreUpdate
    public function CategoryStoreUpdate(DefCategoryRequest $request, $id = 0) {
        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id) {
        $deleteRow = PageCategory::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_page')
            ->firstOrFail();


        if ($deleteRow->del_category_count == 0 and $deleteRow->del_page_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'CategoryPages', 'deleteRow' =>
                    $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'CategoryPages', 'deleteRow' => $deleteRow]);
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
        $mainMenu->sel_routs = "admin.Pages";
        $mainMenu->name = "admin/pages.app_menu";
        $mainMenu->icon = "fab fa-html5";
        $mainMenu->roleView = "Pages_view";
        $mainMenu->save();

        if ($Config['TableCategory']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("PageCategory");
            $subMenu->url = "admin.Pages.PageCategory.index";
            $subMenu->name = "admin/pages.app_menu_category";
            $subMenu->roleView = "Pages_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("PageList");
        $subMenu->url = "admin.Pages.PageList.index";
        $subMenu->name = "admin/pages.app_menu_page";
        $subMenu->roleView = "Pages_view";
        $subMenu->icon = "fas fa-file-code";
        $subMenu->save();


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "PageList.createNew";
        $subMenu->url = "admin.Pages.PageList.create";
        $subMenu->name = "admin/pages.app_menu_add_page";
        $subMenu->roleView = "Pages_view";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        if ($Config['TableTags']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PageTags.index|PageTags.edit|PageTags.create|PageTags.config";
            $subMenu->url = "admin.Pages.PageTags.index";
            $subMenu->name = "admin/pages.app_menu_tags";
            $subMenu->roleView = "Pages_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }


    }
}
