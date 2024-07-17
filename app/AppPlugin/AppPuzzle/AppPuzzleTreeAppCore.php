<?php

namespace App\AppPlugin\AppPuzzle;

use Illuminate\Support\Facades\File;

class AppPuzzleTreeAppCore extends AppPuzzleFun {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  AppCore
    static function AppCore() {
        $modelTree = [
            'AppPuzzle' => self::treeAppPuzzle(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   treeAppPuzzle
    static function treeAppPuzzle() {
        return [
            'view' => true,
            'id' => "AppPuzzle",
            'CopyFolder' => "AppPuzzle",
            'appFolder' => 'AppPuzzle',
            'viewFolder' => 'AppPuzzle',
            'routeFolder' => null,
            'routeFile' => 'appCore.php',
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportAssetsCssFiles() {
        $copy = new AppPuzzleFunCopy();
        $CopyFolder = self::creatCopyFolder("_CoreAssets");

        $folderNames = [
            "public/assets/admin/css",
        ];

        foreach ($folderNames as $folderName) {
            $thisDir = base_path($folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportAssetsFiles() {
        $copy = new AppPuzzleFunCopy();
        $CopyFolder = self::creatCopyFolder("_CoreAssets");

        $folderNames = [
            "public/assets/admin/",
            "public/assets/images/",
            "public/assets/pdf/",
        ];

        foreach ($folderNames as $folderName) {
            $thisDir = base_path($folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
        return redirect()->back();
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportCoreFiles() {
        $copy = new AppPuzzleFunCopy();
        $CopyFolder = self::creatCopyFolder("_Core");

        self::ExportFolderApp($CopyFolder);
        self::ExportFolderConfig($CopyFolder);
        self::ExportFolderDatabase($CopyFolder);
        self::ExportFolderResources($CopyFolder);
        self::ExportFolderRoutes($CopyFolder);
        self::ExportFolderLangFiles($CopyFolder);
        return redirect()->back();

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportFolderApp($CopyFolder) {
        $fileNames = [
            ['Http/' => 'Kernel.php'],
            ['Http/Controllers/' => 'AdminMainController.php'],
            ['Http/Controllers/' => 'AuthAdminController.php'],
            ['Http/Controllers/' => 'Controller.php'],
            ['Http/Controllers/' => 'DefaultMainController.php'],
            ['Http/Controllers/' => 'RouteNotFoundController.php'],

        ];
        foreach ($fileNames as $fileName) {
            foreach ($fileName as $folder => $file) {
                $filePath = app_path($folder . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . 'app/' . $folder;
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }

        $folderNames = [
            "AppCore",
            "Console",
            "Exceptions",
            "Helpers",
            "Http/Controllers/admin",
            "Http/Controllers/Auth",
            "Http/Middleware",
            "Http/Requests/admin",
            "Http/Requests/def",
            "Http/Traits",
            "Models",
            "Providers",
            "View/Components/Admin",
        ];
        foreach ($folderNames as $folderName) {
            $thisDir = app_path($folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . 'app/' . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportFolderConfig($CopyFolder) {
        $ConfigFolder = base_path('config');
        if (File::isDirectory($ConfigFolder)) {
            $destinationFolder = $CopyFolder . 'config/';
            self::recursive_files_copy($ConfigFolder, $destinationFolder);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportFolderResources($CopyFolder) {
        $folderNames = [
            "views/admin",
            "views/admin-auth",
            "views/auth",
            "views/components/admin",
            "views/datatable",
            "views/errors",
            "views/pdf",
        ];
        foreach ($folderNames as $folderName) {
            $thisDir = resource_path($folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . 'resources/' . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportFolderDatabase($CopyFolder) {
        $fileNames = [
            ['database/migrations/' => '2014_10_12_000000_create_users_table.php'],
            ['database/migrations/' => '2014_10_12_100000_create_password_reset_tokens_table.php'],
            ['database/migrations/' => '2014_10_12_100000_create_password_resets_table.php'],
            ['database/migrations/' => '2019_08_19_000000_create_failed_jobs_table.php'],
            ['database/migrations/' => '2019_12_13_000001_create_permission_tables.php'],
            ['database/migrations/' => '2019_12_13_000002_add_names_roles_table.php'],
            ['database/migrations/' => '2019_12_13_000003_add_names_permissions_table.php'],
            ['database/migrations/' => '2019_12_14_000001_create_personal_access_tokens_table.php'],
            ['database/migrations/' => '2019_12_14_000001_create_settings_table.php'],
            ['database/migrations/' => '2019_12_14_000002_create_menu_table.php'],
            ['database/migrations/' => '2019_12_14_000005_create_def_photos_table.php'],
            ['database/migrations/' => '2019_12_14_000006_create_upload_filters_table.php'],
            ['database/migrations/' => '2019_12_14_000007_create_upload_filter_sizes_table.php'],
            ['database/seeders/' => 'DatabaseSeeder.php'],
            ['public/db/' => 'config_def_photos.sql'],
            ['public/db/' => 'config_setting_translations.sql'],
            ['public/db/' => 'config_settings.sql'],
            ['public/db/' => 'config_upload_filter_sizes.sql'],
            ['public/db/' => 'config_upload_filters.sql'],
        ];

        foreach ($fileNames as $fileName) {
            foreach ($fileName as $folder => $file) {
                $filePath = base_path($folder . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . $folder;
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportFolderRoutes($CopyFolder) {
        $folderNames = [
            "routes/adminCore/",
        ];
        foreach ($folderNames as $folderName) {
            $thisDir = base_path($folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ExportFolderLangFiles($CopyFolder) {

        $langs = ['ar', 'en'];
        $fileNames = [];
        foreach ($langs as $lang) {
            $fileNames_new = [
                ["resources/lang/$lang/" => 'admin.php'],
                ["resources/lang/$lang/" => 'alertMass.php'],
                ["resources/lang/$lang/" => 'auth.php'],
                ["resources/lang/$lang/" => 'pagination.php'],
                ["resources/lang/$lang/" => 'passwords.php'],
                ["resources/lang/$lang/" => 'validation.php'],
                ["resources/lang/$lang/admin/config/" => 'dataTable.php'],
                ["resources/lang/$lang/admin/config/" => 'roles.php'],
                ["resources/lang/$lang/admin/config/" => 'settings.php'],
                ["resources/lang/$lang/admin/config/" => 'upFilter.php'],
                ["resources/lang/$lang/admin/config/" => 'webConfig.php'],
                ["resources/lang/$lang/admin/" => 'formFilter.php'],
                ["resources/lang/$lang/admin/" => 'def.php'],
                ["resources/lang/$lang/admin/" => 'defCat.php'],
            ];
            $fileNames = array_merge($fileNames, $fileNames_new);
        }

        foreach ($fileNames as $fileName) {
            foreach ($fileName as $folder => $file) {
                $filePath = base_path($folder . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . $folder;
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function creatCopyFolder($folderName) {
        $CopyFolder = $this->mainFolder . $folderName . '/';
        self::folderMakeDirectory($CopyFolder);
        return $CopyFolder;
    }

}
