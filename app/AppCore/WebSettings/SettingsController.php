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
        $saveData->switch_lang = $request->input('switch_lang');

        $saveData->wish_list = $request->input('wish_list');
        $saveData->users_login = $request->input('users_login');
        $saveData->serach = $request->input('serach');
        $saveData->serach_type = $request->input('serach_type');


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

        $saveData->telegram_send = $request->input('telegram_send');
        $saveData->telegram_key = $request->input('telegram_key');
        $saveData->telegram_phone = $request->input('telegram_phone');
        $saveData->telegram_group = $request->input('telegram_group');

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $saveData->page_about = $request->input('page_about');
            $saveData->page_warranty = $request->input('page_warranty');
            $saveData->page_shipping = $request->input('page_shipping');
            $saveData->pro_sale_lable = $request->input('pro_sale_lable');
            $saveData->pro_quick_view = $request->input('pro_quick_view');
            $saveData->pro_quick_shop = $request->input('pro_quick_shop');
            $saveData->pro_warranty_tab = $request->input('pro_warranty_tab');
            $saveData->pro_shipping_tab = $request->input('pro_shipping_tab');
            $saveData->pro_social_share = $request->input('pro_social_share');

            $saveData->pro_main_city_id = $request->input('pro_main_city_id');
            $saveData->pro_main_city_rate = $request->input('pro_main_city_rate');
            $saveData->pro_main_city_discount = $request->input('pro_main_city_discount');
            $saveData->pro_all_city_rate = $request->input('pro_all_city_rate');
            $saveData->pro_all_city_discount = $request->input('pro_all_city_discount');
        }


        $saveData->save();

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $UpdateCity = City::all();
            foreach ($UpdateCity as $city) {
                if (in_array($city->id, $request->input('pro_main_city_id'))) {
                    $city->rate = $saveData->pro_main_city_rate;
                    $city->discount = $saveData->pro_main_city_discount;
                } else {
                    $city->rate = $saveData->pro_all_city_rate;
                    $city->discount = $saveData->pro_all_city_discount;
                }
                $city->save();
            }
        }

        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = SettingTranslation::where('setting_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key . '.name');
            $saveTranslation->closed_mass = $request->input($key . '.closed_mass');
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

        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "Branch.index|Branch.create|Branch.edit|Branch.config";
            $subMenu->url = "admin.config.Branch.index";
            $subMenu->name = "admin/configBranch.app_menu";
            $subMenu->roleView = "config_branch";
            $subMenu->icon = "fas fa-map-signs";
            $subMenu->save();
        }

    }

}
