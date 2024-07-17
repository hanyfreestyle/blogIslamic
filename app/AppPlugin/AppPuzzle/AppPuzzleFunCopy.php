<?php

namespace App\AppPlugin\AppPuzzle;

use Illuminate\Support\Facades\File;


class AppPuzzleFunCopy extends AppPuzzleFun {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyAppFolder
    public function copyAppFolder($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);
        $folderName = issetArr($thisModel, 'appFolder', null);
        if ($folderName != null) {
            $thisDir = app_path("AppPlugin/" . $folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . 'app/AppPlugin/' . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyViewFolder
    public function copyViewFolder($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);
        $folderName = issetArr($thisModel, 'viewFolder', null);
        if ($folderName != null) {
            $thisDir = resource_path("views/AppPlugin/" . $folderName);
            if (File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . '/resources/views/AppPlugin/' . $folderName . "/";
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyRouteFile
    public function copyRouteFile($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);
        $fileName = issetArr($thisModel, 'routeFile', null);
        $routeFolder = issetArr($thisModel, 'routeFolder', null);
        if ($fileName != null) {
            $filePath = base_path('routes/AppPlugin/' . $routeFolder . $fileName);
            if (File::isFile($filePath)) {
                $destinationFolder = $CopyFolder . '/routes/AppPlugin/' . $routeFolder;
                self::folderMakeDirectory($destinationFolder);
                File::copy($filePath, $destinationFolder . $fileName);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyMigrations
    public function copyMigrations($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);

        $migrations = issetArr($thisModel, 'migrations', null);
        if ($migrations != null and is_array($migrations)) {
            foreach ($migrations as $file) {
                $filePath = base_path('database/migrations/' . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . '/database/migrations/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }

        $seeders = issetArr($thisModel, 'seeder', null);
        if ($seeders != null and is_array($seeders)) {
            foreach ($seeders as $file) {
                $filePath = public_path('db/' . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . '/public/db/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyLangFile
    public function copyLangFile($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);



        $adminLangFiles = issetArr($thisModel, 'adminLangFiles', null);
        $adminLangFolder = issetArr($thisModel, 'adminLangFolder', null);
        if ($adminLangFiles != null and is_array($adminLangFiles)) {
            foreach ($adminLangFiles as $file) {
                foreach (config('app.core_lang') as $key => $lang) {
                    $filePath = resource_path('lang/' . $key . '/' . $adminLangFolder . $file);
                    if (File::isFile($filePath)) {
                        $destinationFolder = $CopyFolder . 'resources/lang/' . $key . '/' . $adminLangFolder;
                        self::folderMakeDirectory($destinationFolder);
                        File::copy($filePath, $destinationFolder . $file);
                    }
                }
            }
        }

        $webLangFiles = issetArr($thisModel, 'webLangFiles', null);
        $webLangFolder = issetArr($thisModel, 'webLangFolder', null);

        if ($webLangFiles != null and is_array($webLangFiles)) {
            foreach ($webLangFiles as $file) {
                foreach (config('app.core_lang') as $key => $lang) {
                    $filePath = resource_path('lang/' . $key . '/' . $webLangFolder . $file);
                    if (File::isFile($filePath)) {
                        $destinationFolder = $CopyFolder . 'resources/lang/' . $key . '/' . $webLangFolder;
                        self::folderMakeDirectory($destinationFolder);
                        File::copy($filePath, $destinationFolder . $file);
                    }
                }
            }
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyPhotoFolder
    public function copyPhotoFolder($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);

        $photoFolder = issetArr($thisModel, 'photoFolder', null);
        if ($photoFolder != null and is_array($photoFolder)) {
            foreach ($photoFolder as $folderName) {
                $thisDir = public_path("images/" . $folderName);
                if (File::isDirectory($thisDir)) {
                    $destinationFolder = $CopyFolder . 'public/images/' . $folderName;
                    self::recursive_files_copy($thisDir, $destinationFolder);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyAssetsFolder
    public function copyAssetsFolder($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);
        $assetsFolder = issetArr($thisModel, 'assetsFolder', null);
        if ($assetsFolder != null and is_array($assetsFolder)) {
            foreach ($assetsFolder as $folderName) {
                $thisDir = public_path("assets/" . $folderName);
                if (File::isDirectory($thisDir)) {
                    $destinationFolder = $CopyFolder . 'public/assets/' . $folderName;
                    self::recursive_files_copy($thisDir, $destinationFolder);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyComponentFolder
    public function copyComponentFolder($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);

        $ComponentFolderClass = issetArr($thisModel, 'ComponentFolderClass', null);
        if ($ComponentFolderClass != null and is_array($ComponentFolderClass)) {
            foreach ($ComponentFolderClass as $folderName) {
                $thisDir = app_path("View/Components/" . $folderName);
                if (File::isDirectory($thisDir)) {
                    $destinationFolder = $CopyFolder . 'app/View/Components/' . $folderName;
                    self::recursive_files_copy($thisDir, $destinationFolder);
                }
            }
        }

        $ComponentFolderView = issetArr($thisModel, 'ComponentFolderView', null);
        if ($ComponentFolderView != null and is_array($ComponentFolderView)) {
            foreach ($ComponentFolderView as $folderName) {
                $thisDir = resource_path("views/components/" . $folderName);
                if (File::isDirectory($thisDir)) {
                    $destinationFolder = $CopyFolder . 'resources/views/components/' . $folderName;
                    self::recursive_files_copy($thisDir, $destinationFolder);
                }
            }
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyComponentFile
    public function copyComponentFile($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);

        if (isset($thisModel['ComponentFileClass']) and is_array($thisModel['ComponentFileClass'])) {
            foreach ($thisModel['ComponentFileClass'] as $list) {
                foreach ($list as $folder => $file) {
                    $filePath = app_path('View/Components/' . $folder . '/' . $file);
                    if (File::isFile($filePath)) {
                        $destinationFolder = $CopyFolder . 'app/View/Components/' . $folder . "/";
                        self::folderMakeDirectory($destinationFolder);
                        File::copy($filePath, $destinationFolder . $file);
                    }
                }
            }
        }

        if (isset($thisModel['ComponentFileView']) and is_array($thisModel['ComponentFileView'])) {
            foreach ($thisModel['ComponentFileView'] as $list) {
                foreach ($list as $folder => $file) {
                    $filePath = resource_path('views/components/' . $folder . '/' . $file);
                    if (File::isFile($filePath)) {
                        $destinationFolder = $CopyFolder . 'resources/views/components/' . $folder . "/";
                        self::folderMakeDirectory($destinationFolder);
                        File::copy($filePath, $destinationFolder . $file);
                    }
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     copyLivewireFile
    public function copyLivewireFile($thisModel) {
        $CopyFolder = self::creatCopyFolder($thisModel);

        if (isset($thisModel['livewireClass']) and is_array($thisModel['livewireClass'])) {
            foreach ($thisModel['livewireClass'] as $folder => $file) {
                $filePath = app_path('Http/Livewire/' . $folder . '/' . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . 'app/Http/Livewire/' . $folder . "/";
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }
        if (isset($thisModel['livewireView']) and is_array($thisModel['livewireView'])) {
            foreach ($thisModel['livewireView'] as $folder => $file) {
                $filePath = resource_path('views/livewire/' . $folder . '/' . $file);
                if (File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . 'resources/views/livewire/' . $folder . "/";
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }
    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     copyxx
//    public function  copyxx($thisModel){
//        $CopyFolder = self::creatCopyFolder($thisModel);
//    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     copyxx
//    public function  copyxx($thisModel){
//        $CopyFolder = self::creatCopyFolder($thisModel);
//    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     copyxx
//    public function  copyxx($thisModel){
//        $CopyFolder = self::creatCopyFolder($thisModel);
//    }


}
