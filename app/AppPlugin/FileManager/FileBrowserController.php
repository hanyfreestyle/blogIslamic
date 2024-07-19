<?php

namespace App\AppPlugin\FileManager;

use App\AppCore\Menu\AdminMenu;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class FileBrowserController extends Controller {

    function __construct() {
        $this->PrefixRole = 'FileManager';
        View::share('PrefixRole', $this->PrefixRole);

        $this->defDir = "wp-content/uploads/";
        View::share('defDir', $this->defDir);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     FileBrowser
    public function FileBrowser() {
        $view_path = public_path(self::defDir());
        $photoUrl = self::getPhotoList($view_path);
        $directories = self::expandDirectoriesMatrix(public_path($this->defDir), $level = 0);
        $db_directories = FileManager::where('type', 'folder')->pluck('path')->toarray();
        $db_photos = FileManager::where('type', 'photo')->pluck('path')->toarray();
        return view("AppPlugin.FileManager.browser_index")->with(
            [
                'directories' => $directories,
                'photoUrl' => $photoUrl,
                'db_directories' => $db_directories,
                'db_photos' => $db_photos,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ListPhoto
    public function ListPhoto(Request $request) {
        $view_path = $request->path;
        $photoUrl = self::getPhotoList($view_path);
        $db_photos = FileManager::where('type', 'photo')->pluck('path')->toarray();
        $returnHTML = view('AppPlugin.FileManager.browser_tree_photo', compact('photoUrl', 'db_photos'))->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   getPhotoList
    static function getPhotoList($view_path) {
        $files = File::files($view_path);
        $base_path = public_path();
        $photoUrl = [];
        foreach ($files as $file) {
            $relativePart = str_replace($base_path, '', $file->getRealPath());
            $url = url("/" . trim($relativePart, "/\\"));
            $url = str_replace('\\', '/', $url);;
            $photoUrl = array_merge($photoUrl, [$url]);
        }
        return $photoUrl;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CkeditorUpload
    public function CkeditorUpload(Request $request) {
        if ($request->hasFile('upload')) {
            $saveImgData = new PuzzleUploadProcess();
            $oldName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($oldName, PATHINFO_FILENAME);
            $saveImgData->setUploadDirIs(self::defDir(), null)->setnewFileName($fileName)->setfileUploadName('upload');
            $saveImgData->UploadOneNofilter($request, '2', 700, 300);
            $url = asset($saveImgData->sendSaveData['photo']['file_name']);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   defDir
    static function defDir() {
        $year = date('Y', time());
        $month = date('m', time());
//        $dir = 'media/' . $year . '/' . $month;
        $dir = 'wp-content/uploads/' . $year . '/' . $month;
        $view_path = public_path($dir);
        if (!File::isDirectory($view_path)) {
            File::makeDirectory($view_path, 0777, true, true);
        }
        return $dir;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   expandDirectoriesMatrix
    static function expandDirectoriesMatrix($base_dir, $level = 0) {
        $directories = array();
        foreach (scandir($base_dir) as $file) {
            if ($file == '.' || $file == '..') continue;
            $dir = $base_dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($dir)) {
                $directories[] = array(
                    'level' => $level,
                    'name' => $file,
                    'path' => $dir,
                    'children' => self::expandDirectoriesMatrix($dir, $level + 1)
                );
            }
        }
        return $directories;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {
        $mainMenu = new AdminMenu();
        $mainMenu->type = "One";
        $mainMenu->sel_routs = "admin.fileManager";
        $mainMenu->url = "admin.fileManager.index";
        $mainMenu->name = "admin/fileManager.app_menu";
        $mainMenu->icon = "fas fa-images";
        $mainMenu->roleView = "FileManager_view";
        $mainMenu->postion =  150;
        $mainMenu->save();
    }

}
