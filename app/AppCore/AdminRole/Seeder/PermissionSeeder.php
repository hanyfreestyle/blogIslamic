<?php

namespace App\AppCore\AdminRole\Seeder;

use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\AppPlugin\Models\MainPost\Traits\MainPostPermissionTraits;
use App\Http\Traits\CrmFunTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {

    public function run(): void {

        $data = [
            ['cat_id' => 'users', 'name' => 'users_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'users', 'name' => 'users_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'users', 'name' => 'users_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'users', 'name' => 'users_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'users', 'name' => 'users_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],

            ['cat_id' => 'roles', 'name' => 'roles_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'roles', 'name' => 'roles_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'roles', 'name' => 'roles_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'roles', 'name' => 'roles_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'roles', 'name' => 'roles_update_permissions', 'name_ar' => 'تعديل صلاحيات المجموعة', 'name_en' => 'Roles Update Permissions'],
        ];

        $data = CrmFunTraits::LoadPermission($data);

        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            $newPer = [
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $newPer = [
                ['cat_id' => 'Product', 'name' => 'Product_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Product', 'name' => 'Product_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Product', 'name' => 'Product_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Product', 'name' => 'Product_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Product', 'name' => 'Product_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Product', 'name' => 'Product_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
            $newPer = [
                ['cat_id' => 'orders', 'name' => 'orders_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'orders', 'name' => 'orders_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'orders', 'name' => 'orders_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'orders', 'name' => 'orders_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
            $newPer = [
                ['cat_id' => 'customer', 'name' => 'customer_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'customer', 'name' => 'customer_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'customer', 'name' => 'customer_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'customer', 'name' => 'customer_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'customer', 'name' => 'customer_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {
            $data = MainPostPermissionTraits::LoadPermission($data);
        }

        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {
            $newPer = [
                ['cat_id' => 'Blog', 'name' => 'Blog_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Blog', 'name' => 'Blog_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Blog', 'name' => 'Blog_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Blog', 'name' => 'Blog_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Blog', 'name' => 'Blog_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Blog', 'name' => 'Blog_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            $newPer = [
                ['cat_id' => 'Pages', 'name' => 'Pages_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Pages', 'name' => 'Pages_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Pages', 'name' => 'Pages_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Pages', 'name' => 'Pages_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Pages', 'name' => 'Pages_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Pages', 'name' => 'Pages_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }


        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            $newPer = [
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/faq.php'))) {
            $newPer = [
                ['cat_id' => 'Faq', 'name' => 'Faq_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Faq', 'name' => 'Faq_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Faq', 'name' => 'Faq_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Faq', 'name' => 'Faq_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Faq', 'name' => 'Faq_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Faq', 'name' => 'Faq_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        $configPer = [
            ['cat_id' => 'config', 'name' => 'config_view', 'name_ar' => 'عرض الاعدادات', 'name_en' => 'Setting View'],
            ['cat_id' => 'config', 'name' => 'config_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'config', 'name' => 'config_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'config', 'name' => 'config_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'config', 'name' => 'config_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ['cat_id' => 'config', 'name' => 'config_website', 'name_ar' => 'اعدادات الموقع', 'name_en' => 'Web Site Setting'],
            ['cat_id' => 'config', 'name' => 'config_defPhoto_view', 'name_ar' => 'الصور الافتراضية', 'name_en' => 'View'],
            ['cat_id' => 'config', 'name' => 'config_upFilter_view', 'name_ar' => 'فلاتر الصور', 'name_en' => 'View'],
            ['cat_id' => 'config', 'name' => 'config_newsletter', 'name_ar' => 'القائمة البريدية', 'name_en' => 'News Letter'],
            ['cat_id' => 'config', 'name' => 'adminlang_view', 'name_ar' => 'ملفات لغة التحكم', 'name_en' => 'Admin Lang File'],
            ['cat_id' => 'config', 'name' => 'weblang_view', 'name_ar' => 'ملفات لغة الموقع', 'name_en' => 'Web Lang File'],
            ['cat_id' => 'config', 'name' => 'sitemap_view', 'name_ar' => 'SiteMap', 'name_en' => 'SiteMap'],
        ];

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_meta_view', 'name_ar' => 'ميتا تاج', 'name_en' => 'Meta']];
            $configPer = array_merge($configPer, $newPer);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_web_privacy', 'name_ar' => 'سياسية الاستخدام', 'name_en' => 'Web Privacy']];
            $configPer = array_merge($configPer, $newPer);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_branch', 'name_ar' => 'الفروع', 'name_en' => 'Branch']];
            $configPer = array_merge($configPer, $newPer);
        }
        $data = array_merge($data, $configPer);

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {
            $manageData = [
                ['cat_id' => 'data', 'name' => 'data_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'data', 'name' => 'data_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'data', 'name' => 'data_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'data', 'name' => 'data_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'data', 'name' => 'data_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $manageData = ConfigDataTraits::LoadPermission($manageData);
            $data = array_merge($data, $manageData);
        }

        if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
            $newPer = [
                ['cat_id' => 'leads', 'name' => 'leads_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'leads', 'name' => 'leads_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'leads', 'name' => 'leads_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'leads', 'name' => 'leads_export', 'name_ar' => 'تصدير', 'name_en' => 'Export'],
                ['cat_id' => 'leads', 'name' => 'leads_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            $newPer = [
                ['cat_id' => 'FileManager', 'name' => 'FileManager_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'FileManager', 'name' => 'FileManager_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'FileManager', 'name' => 'FileManager_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'FileManager', 'name' => 'FileManager_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ];
            $data = array_merge($data, $newPer);
        }


        $countData = Permission::all()->count();
        if ($countData == '0') {
            foreach ($data as $value) {
                Permission::create($value);
            }
        }

    }
}
