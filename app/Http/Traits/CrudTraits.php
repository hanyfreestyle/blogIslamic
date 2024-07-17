<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Requests\admin\MorePhotosEditRequest;
use App\Http\Requests\admin\MorePhotosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait CrudTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {

        $deleteRow = $this->model->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function Restore($id) {
        $restore = $this->model->onlyTrashed()->where('id', $id)->firstOrFail();
        $restore->restore();
        self::ClearCash();
        return back()->with('restore', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDelete
    public function ForceDelete($id) {
        $deleteRow = $this->model->onlyTrashed()->where('id', $id)->firstOrFail();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     emptyPhoto
    public function emptyPhoto($id) {
        $rowData = $this->model->where('id', $id)->firstOrFail();
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true);
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     emptyPhoto
    public function emptyIcon($id) {
        $rowData = $this->model->where('id', $id)->firstOrFail();
        if(File::exists($rowData->icon)) {
            File::delete($rowData->icon);
        }
        $rowData->icon = null;
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     config
    public function config() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListMorePhoto
    public function ListMorePhoto(Request $request) {
        if(!$this->TableMorePhotos){
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $id = $request->route()->parameter('id');
        $Model = $this->model->where('id', $id)->firstOrFail();
        $ListPhotos = $this->modelPhoto->where($this->modelPhotoColumn, $id)->orderBy('position')->get();
        return view('admin.mainView.MorePhoto_add', compact('ListPhotos', 'pageData', 'Model'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AddMorePhotos
    public function AddMorePhotos(MorePhotosRequest $request) {
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs($this->UploadDirIs . '/' . $request->input('model_id'));
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);
        $modelPhotoColumn = $this->modelPhotoColumn;

        foreach ($saveImgData->sendSaveData as $newPhoto) {
            $saveData = $this->modelPhoto->findOrNew('0');
            $saveData->$modelPhotoColumn = $request->model_id;
            if(isset($newPhoto['photo']['file_name'])) {
                $saveData->photo = $newPhoto['photo']['file_name'];
            }
            if(isset($newPhoto['photo_thum_1']['file_name'])) {
                $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            }
            $saveData->save();
        }
        self::ClearCash();
        return back()->with('Add.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
    public function More_PhotosDestroy($id) {
        $deleteRow = $this->modelPhoto->findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortPhotoSave(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = $this->modelPhoto->findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DeleteLang
    public function DeleteLang($id) {
        $dbName = $this->translationdb;
        $deleteRow = $this->translation->where('id', $id)->firstOrFail();
        $countLang = $this->translation->where($dbName, $deleteRow->$dbName)->count();
        if($countLang > 1) {
            $deleteRow->delete();
        } else {
            abort(404);
        }
        self::ClearCash();
        return redirect(route($this->PrefixRoute . '.edit', $deleteRow->$dbName))->with('confirmDelete', "");
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosEdit
    public function More_PhotosEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->modelPhoto::where('id', $id)->with('modelName')->firstOrFail();
        return view('admin.mainView.MorePhoto_edit', compact('rowData', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosUpdate
    public function More_PhotosUpdate(MorePhotosEditRequest $request, $id) {

        $saveData = $this->modelPhoto::findOrNew($id);
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs($this->UploadDirIs ."/". $request->input('model_id'));
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();

        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = $this->photoTranslation::where("photo_id", $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->photo_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->des = $request->input($key . '.des');
            $saveTranslation->save();
        }

        self::ClearCash();
        return redirect()->back()->with('Edit.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosEditAll
    public function More_PhotosEditAll($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $thisModel = $this->model::findOrFail($id) ;
        $rowData = $this->modelPhoto::where($this->modelPhotoColumn,'=',$id)->with('translations')->orderBy('position')->get();
        return view('admin.mainView.MorePhoto_editAll', compact('rowData', 'pageData','thisModel'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   More_PhotosUpdateAll
    public function More_PhotosUpdateAll(Request $request, $id){
        foreach ($request->input('id') as $id){
            $UpdatePhoto = $this->modelPhoto::findOrFail($id) ;
            $UpdatePhoto->print_photo = $request->input('print_photo_'.$id) ?? 2;
            $UpdatePhoto->save();

            foreach (config('app.web_lang') as $key => $lang) {
                $saveTranslation = $this->photoTranslation::where('photo_id', $UpdatePhoto->id)->where('locale', $key)->firstOrNew();
                $saveTranslation->photo_id = $UpdatePhoto->id;
                $saveTranslation->locale = $key;
                $saveTranslation->des = $request->input('des_'.$key.'_'.$id);
                $saveTranslation->save();
            }
        }
        self::ClearCash();
        return redirect()->back()->with('Edit.Done', "");
    }

}
