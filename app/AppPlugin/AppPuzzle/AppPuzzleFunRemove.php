<?php

namespace App\AppPlugin\AppPuzzle;
use Illuminate\Support\Facades\File;


class AppPuzzleFunRemove extends AppPuzzleFun {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeAppFolder
    public function  removeAppFolder($thisModel){
        $appFolder = issetArr($thisModel,'appFolder',null);
        if($appFolder != null) {
            $thisDir = app_path("AppPlugin/".$appFolder);
            if(File::isDirectory($thisDir)) {
                File::deleteDirectory($thisDir);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeViewFolder
    public function  removeViewFolder($thisModel){
        $viewFolder = issetArr($thisModel,'viewFolder',null);
        if( $viewFolder != null) {
            $thisDir = resource_path("views/AppPlugin/".$viewFolder);
            if(File::isDirectory($thisDir)) {
                File::deleteDirectory($thisDir);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeRouteFile
    public function  removeRouteFile($thisModel){
        $fileName = issetArr($thisModel,'routeFile',null);
        $routeFolder = issetArr($thisModel,'routeFolder',null);
        if($fileName != null) {
            $filePath = base_path('routes/AppPlugin/' . $routeFolder . $fileName);
            if(File::isFile($filePath)) {
                File::delete($filePath);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeMigrations
    public function  removeMigrations($thisModel){
        $migrations = issetArr($thisModel,'migrations',null);
        if($migrations != null and is_array($migrations)) {
            foreach ($migrations as $file) {
                $filePath = base_path('database/migrations/' . $file);
                if(File::isFile($filePath)) {
                    File::delete($filePath);
                }
            }
        }


        $seeder = issetArr($thisModel,'seeder',null);
        if($seeder != null and is_array($seeder)) {
            foreach ($seeder as $file) {
                $filePath = public_path('db/' . $file);
                if(File::isFile($filePath)) {
                    File::delete($filePath);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeLangFiles
    public function  removeLangFiles($thisModel){
        $adminLangFiles = issetArr($thisModel,'adminLangFiles',null);
        $adminLangFolder = issetArr($thisModel,'adminLangFolder',null);
        if($adminLangFiles != null and is_array($adminLangFiles)) {
            foreach ($adminLangFiles as $file){
                foreach (config('app.admin_lang') as $key => $lang) {
                    $filePath = resource_path('lang/' . $key . '/' . $adminLangFolder . $file);
                    if(File::isFile($filePath)) {
                        File::delete($filePath);
                    }
                }
            }
        }

        $webLangFiles = issetArr($thisModel,'webLangFiles',null);
        $webLangFolder = issetArr($thisModel,'webLangFolder',null);
        if($webLangFiles != null and is_array($webLangFiles)) {
            foreach ($webLangFiles as $file){
                foreach (config('app.web_lang') as $key => $lang) {
                    $filePath = resource_path('lang/' . $key . '/' . $webLangFolder . $file);
                    if(File::isFile($filePath)) {
                        File::delete($filePath);
                    }
                }
            }
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removePhotoFolder
    public function  removePhotoFolder($thisModel){
        $photoFolder = issetArr($thisModel,'photoFolder',null);
        if($photoFolder != null and is_array($photoFolder)) {
            foreach ($photoFolder as $folderName ){
                $thisDir = public_path("images/" . $folderName);
                if(File::isDirectory($thisDir)) {
                    File::deleteDirectory($thisDir);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeAssetsFolder
    public function  removeAssetsFolder($thisModel){
        $assetsFolder = issetArr($thisModel,'assetsFolder',null);
        if($assetsFolder != null and is_array($assetsFolder)) {
            foreach ($assetsFolder as $folderName ){
                $thisDir = public_path("assets/" . $folderName);
                if(File::isDirectory($thisDir)) {
                    File::deleteDirectory($thisDir);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeComponentFolder
    public function  removeComponentFolder($thisModel){
        $ComponentFolderClass = issetArr($thisModel,'ComponentFolderClass',null);
        if($ComponentFolderClass != null and is_array($ComponentFolderClass)) {
            foreach ($ComponentFolderClass as $folderName ){
                $thisDir = app_path("View/Components/" . $folderName);
                if(File::isDirectory($thisDir)) {
                    File::deleteDirectory($thisDir);
                }
            }
        }

        $ComponentFolderView = issetArr($thisModel,'ComponentFolderView',null);
        if($ComponentFolderView != null and is_array($ComponentFolderView)) {
            foreach ($ComponentFolderView as $folderName ){
                $thisDir = resource_path("views/components/" . $folderName);
                if(File::isDirectory($thisDir)) {
                    File::deleteDirectory($thisDir);
                }
            }
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeComponentFile
    public function  removeComponentFile($thisModel){
        if(isset($thisModel['ComponentFileClass']) and is_array($thisModel['ComponentFileClass'])) {
            foreach ($thisModel['ComponentFileClass'] as $list){
                foreach ($list as $folder => $file ){
                    $filePath = app_path('View/Components/'.$folder.'/'.$file);
                    if(File::isFile($filePath)) {
                        File::delete($filePath);
                    }
                }
            }
        }
        if(isset($thisModel['ComponentFileView']) and is_array($thisModel['ComponentFileView'])) {
            foreach ($thisModel['ComponentFileView'] as $list){
                foreach ($list as $folder => $file ){
                    $filePath = resource_path('views/components/'.$folder.'/'.$file);
                    if(File::isFile($filePath)) {
                        File::delete($filePath);
                    }
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     removeLivewireFile
    public function  removeLivewireFile($thisModel){

        if(isset($thisModel['livewireClass']) and is_array($thisModel['livewireClass'])) {
            foreach ($thisModel['livewireClass'] as $folder => $file){
                $filePath = app_path('Http/Livewire/'.$folder.'/'.$file);
                if(File::isFile($filePath)) {
                    File::delete($filePath);
                }
            }
        }
        if(isset($thisModel['livewireView']) and is_array($thisModel['livewireView'])) {
            foreach ($thisModel['livewireView'] as $folder => $file){
                $filePath = resource_path('views/livewire/'.$folder.'/'.$file);
                if(File::isFile($filePath)) {
                    File::delete($filePath);
                }
            }
        }

    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     copyxx
//    public function  copyxx($thisModel){

//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     copyxx
//    public function  copyxx($thisModel){

//    }


}
