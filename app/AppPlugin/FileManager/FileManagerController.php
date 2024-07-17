<?php

namespace App\AppPlugin\FileManager;


use App\AppCore\UploadFilter\Models\UploadFilter;
use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


class FileManagerController extends AdminMainController {

    function __construct() {
        parent::__construct();
        $this->controllerName = "fileManager";
        $this->PrefixRole = 'FileManager';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/fileManager.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'configArr' => ["filterid" => 0, "orderbyPostion" => 1],
            'yajraTable' => false,
            'AddLang' => false,
            'restore' => 0,
            'AddButToCard' => false,
        ];

        self::loadConstructData($sendArr);

        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['index']]);
        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => []]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => ['listFolder','updateFolder','updatePhoto']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => ['destroy', 'destroyException']]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $view_path = public_path(FileBrowserController::defDir());
        $photoUrl = FileBrowserController::getPhotoList($view_path);


        $db_photos = FileManager::where('type', 'photo')->pluck('path')->toarray();

        if(Route::currentRouteName() == 'admin.fileManager.index') {
            $viewType = 'admin';
            $cardTitle = __('admin/fileManager.app_menu');
            $db_directories = FileManager::where('type', 'folder')->pluck('path')->toarray();

        } elseif(Route::currentRouteName() == 'admin.fileManager.listDeletePhoto') {
            $viewType = 'DeletePhoto';
            $cardTitle = __('admin/fileManager.menu_delete_photo');
            $db_directories = [];
        }
        $directories = FileBrowserController::expandDirectoriesMatrix(public_path('media'), $level = 0);

        return view("AppPlugin.FileManager.fileManager_index")->with(
            [
                'pageData' => $pageData,
                'directories' => $directories,
                'photoUrl' => $photoUrl,
                'db_directories' => $db_directories,
                'db_photos' => $db_photos,
                'viewType' => $viewType,
                'cardTitle' => $cardTitle,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ListPhoto
    public function ListPhoto(Request $request) {
        $view_path = $request->path;
        $photoUrl = FileBrowserController::getPhotoList($view_path);
        $db_photos = FileManager::where('type', 'photo')->pluck('path')->toarray();
        $viewType = $request->viewType;
        $returnHTML = view('AppPlugin.FileManager.fileManager_tree_photo', compact('photoUrl', 'db_photos', 'viewType'))->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     listFolder
    public function listFolder() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $db_directories = FileManager::where('type', 'folder')->pluck('path')->toarray();

        $FileBrowser = new FileBrowserController();
        $directories = $FileBrowser->expandDirectoriesMatrix(public_path('media'), $level = 0);
        return view("AppPlugin.FileManager.fileManager_list_folder", compact('directories', 'pageData', 'db_directories'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     updateFolder
    public function updateFolder(Request $request) {
        $path = $request->path;
        $deletePath = FileManager::where('type', 'folder')->where('path', $path)->first();
        if($deletePath != null) {
            $deletePath->delete();
            $icon = '<i class="fas fa-trash-alt"></i>';
            $add = 'removeFromList';
            $remove = 'addToList';
        } else {
            $addnew = new FileManager();
            $addnew->type = "folder";
            $addnew->path = $path;
            $addnew->save();
            $icon = '<i class="fas fa-plus"></i>';
            $remove = 'removeFromList';
            $add = 'addToList';
        }
        return response()->json(['icon' => $icon, 'add' => $add, 'remove' => $remove]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     updatePhoto
    public function updatePhoto(Request $request) {
        $path = $request->path;
        $deletePath = FileManager::where('type', 'photo')->where('path', $path)->first();
        if($deletePath != null) {
            $deletePath->delete();
        } else {
            $addnew = new FileManager();
            $addnew->type = "photo";
            $addnew->path = $path;
            $addnew->save();
        }
        return response()->json(['done' => true]);
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     listFolder
    public function addPhoto() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $FileBrowser = new FileBrowserController();
        $directories = $FileBrowser->expandDirectoriesMatrix(public_path('media'), $level = 0);
        $directories = collect($directories);

        return view("AppPlugin.FileManager.fileManager_add_photos")->with(
            [
                'pageData' =>$pageData ,
                'directories' =>$directories ,
            ],
        );
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadPhotos
    public function UploadPhotos(UploadPhotosRequest $request) {
        $path = $request->input('path');
        $newFolder = $request->input('new_folder');
        if($path == null){
            $UploadDirIs = public_path('media/'.$newFolder);
        }else{
            if($newFolder == null){
                $UploadDirIs = $path;
            }else{
                $UploadDirIs = $path.'/'.AdminHelper::Url_Slug($newFolder,['delimiter'=>'_']);
            }
        }

        if(!File::isDirectory($UploadDirIs)) {
            File::makeDirectory($UploadDirIs, 0777, true, true);
        }

        $filterData = UploadFilter::where('id',$request->filter_id)->first();
        if($filterData == null){
            $sendFilter = ['type'=>2,'width'=>700,'height'=>20,'canvas_back'=>'#fff',];
        }else{
            $sendFilter = ['type'=>$filterData->type,'width'=>$filterData->new_w,'height'=>$filterData->new_h,'canvas_back'=>$filterData->canvas_back];
        }
        $images =  $request->file('image');

        if($images!= null){
            foreach ($images as $key => $file) {
                $saveImgData = new PuzzleUploadProcess();
                $saveImgData->UploadImageFileManger($UploadDirIs."/",$sendFilter, $file);
            }
        }
        return redirect()->route('admin.fileManager.addPhoto',['path'=>$UploadDirIs,'filter'=>$request->filter_id]);

    }

}
