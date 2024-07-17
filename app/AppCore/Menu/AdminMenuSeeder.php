<?php

namespace App\AppCore\Menu;

use App\AppCore\AdminRole\PermissionController;
use App\AppCore\LangFile\LangFileController;
use App\AppCore\WebSettings\SettingsController;

use App\AppPlugin\BlogPost\BlogCategoryController;
use App\AppPlugin\Config\Apps\AppSettingController;
use App\AppPlugin\Config\WebLangFile\LangFileWebController;
use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsController;
use App\AppPlugin\CustomersAdmin\CustomerAdminController;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\AppPlugin\Faq\FaqCategoryController;
use App\AppPlugin\FileManager\FileBrowserController;
use App\AppPlugin\Leads\ContactUs\ContactUsFormController;
use App\AppPlugin\Models\BlogPost\BlogPostCategoryController;
use App\AppPlugin\Orders\OrderController;
use App\AppPlugin\Pages\PageCategoryController;
use App\AppPlugin\Product\ProductController;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class AdminMenuSeeder extends Seeder {

    public function run(): void {

        SettingsController::AdminMenu();
        PermissionController::AdminMenu();
        LangFileController::AdminMenu();

        if (File::isFile(base_path('routes/AppPlugin/config/WebLangFile.php'))) {
            LangFileWebController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            AppSettingController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {
            ConfigDataTraits::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {
            if (File::isFile(base_path('routes/AppPlugin/model/blogPost.php'))) {
                $loadMenu = new BlogPostCategoryController;
                $loadMenu->LoadAdminMenu();
            }
        }


        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {
            BlogCategoryController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/faq.php'))) {
            FaqCategoryController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            PageCategoryController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            FileBrowserController::AdminMenu();
        }


        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            CrmCustomersController::AdminMenu();
        }
        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            PeriodicalsController::AdminMenu();
        }


        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            ProductController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
            CustomerAdminController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
            OrderController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
            ContactUsFormController::AdminMenu();
        }


        Cache::forget('CashAdminMenuList');
    }
}
