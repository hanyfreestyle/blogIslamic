<?php

namespace App\AppCore\WebSettings;

use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppCore\WebSettings\Request\SettingFormRequest;
use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Pages\Models\Page;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;


class SettingsController extends AdminMainController {

    function __construct() {

        parent::__construct();
        $this->controllerName = "config";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/webConfig.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddButToCard' => false,
        ];
        self::loadConstructData($sendArr);

        $this->middleware('permission:config_edit', ['only' => ['webConfigUpdate']]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('WebConfig_Cash');
        Cache::forget('CashCityList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   webConfigEdit
    public function webConfigEdit() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $setting = Setting::findOrFail(1);
        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            $pagesList = Page::all();
        } else {
            $pagesList = [];
        }

        return view('admin.appCore.config.settingWeb')->with([
            'pageData' => $pageData,
            'setting' => $setting,
            'pagesList' => $pagesList,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webConfigUpdate
    public function webConfigUpdate(SettingFormRequest $request) {

        $saveData = Setting::findorfail('1');
        $saveData->web_status = $request->input('web_status');
//        $saveData->switch_lang = $request->input('switch_lang');

        $saveData->phone_num = $request->input('phone_num');
        $saveData->whatsapp_num = $request->input('whatsapp_num');
        $saveData->phone_call = $request->input('phone_call');
        $saveData->whatsapp_send = $request->input('whatsapp_send');
        $saveData->email = $request->input('email');
        $saveData->def_url = $request->input('def_url');

        $saveData->facebook = $request->input('facebook');
        $saveData->youtube = $request->input('youtube');
        $saveData->twitter = $request->input('twitter');
        $saveData->instagram = $request->input('instagram');
        $saveData->linkedin = $request->input('linkedin');
        $saveData->google_api = $request->input('google_api');

        $saveData->schema_type = $request->input('schema_type');
        $saveData->schema_lat = $request->input('schema_lat');
        $saveData->schema_long = $request->input('schema_long');
        $saveData->schema_postal_code = $request->input('schema_postal_code');
        $saveData->schema_country = $request->input('schema_country');

        $saveData->save();


        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = SettingTranslation::where('setting_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key . '.name');
            $saveTranslation->closed_mass = $request->input($key . '.closed_mass');
            $saveTranslation->whatsapp_des = $request->input($key . '.whatsapp_des');
            $saveTranslation->meta_des = $request->input($key . '.meta_des');
            $saveTranslation->schema_address = $request->input($key . '.schema_address');
            $saveTranslation->schema_city = $request->input($key . '.schema_city');
            $saveTranslation->save();
        }

        self::ClearCash();
        return back()->with('Edit.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.config";
        $mainMenu->name = "admin.app_menu_setting";
        $mainMenu->icon = "fas fa-cogs";
        $mainMenu->roleView = "config_view";
        $mainMenu->postion = 80;
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "web.index";
        $subMenu->url = "admin.config.web.index";
        $subMenu->name = "admin/config/webConfig.app_menu";
        $subMenu->roleView = "config_website";
        $subMenu->icon = "fas fa-cog";
        $subMenu->save();

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "Meta.index|Meta.create|Meta.edit|Meta.config";
            $subMenu->url = "admin.config.Meta.index";
            $subMenu->name = "admin/configMeta.app_menu";
            $subMenu->roleView = "config_meta_view";
            $subMenu->icon = "fab fa-html5";
            $subMenu->save();
        }

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "defPhoto.index|defPhoto.create|defPhoto.edit|defPhoto.config|defPhoto.sortDefPhotoList";
        $subMenu->url = "admin.config.defPhoto.index";
        $subMenu->name = "admin/config/upFilter.app_menu_def_photo";
        $subMenu->roleView = "config_defPhoto_view";
        $subMenu->icon = "fas fa-image";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "upFilter.index|upFilter.create|upFilter.edit|upFilter.config|upFilter.size.create|upFilter.size.edit";
        $subMenu->url = "admin.config.upFilter.index";
        $subMenu->name = "admin/config/upFilter.app_menu";
        $subMenu->roleView = "config_upFilter_view";
        $subMenu->icon = "fas fa-filter";
        $subMenu->save();

        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "WebPrivacy.index|WebPrivacy.create|WebPrivacy.edit|WebPrivacy.config";
            $subMenu->url = "admin.config.WebPrivacy.index";
            $subMenu->name = "admin/configPrivacy.app_menu";
            $subMenu->roleView = "config_web_privacy";
            $subMenu->icon = "fas fa-file-alt";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "NewsLetter.index";
            $subMenu->url = "admin.config.NewsLetter.index";
            $subMenu->name = "admin/leadsNewsLetter.app_menu";
            $subMenu->roleView = "config_newsletter";
            $subMenu->icon = "fas fa-mail-bulk";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "SiteMap.index";
            $subMenu->url = "admin.config.SiteMap.index";
            $subMenu->name = "Site Maps";
            $subMenu->roleView = "sitemap_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }


    }

}
