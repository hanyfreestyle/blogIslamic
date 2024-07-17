<?php

namespace App\Http\Traits;

use App\AppPlugin\Data\ConfigData\Request\ConfigDataRequest;
use App\Helpers\AdminHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


trait CrmFunTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   LoadLangFiles
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $addLang = ['CrmCustomers' =>
                ['id' => 'CrmCustomers', 'group' => 'admin', 'sub_dir' => 'crm', 'file_name' => 'customers',
                    'name_en' => 'Customers', 'name_ar' => 'العملاء']
            ];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   LoadPermission
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $newPer = [
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        return $data;
    }
}
