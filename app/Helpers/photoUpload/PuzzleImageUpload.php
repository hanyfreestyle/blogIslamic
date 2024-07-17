<?php

namespace App\Helpers\photoUpload;

use App\Helpers\AdminHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PuzzleImageUpload {
    public $UploadDirIs;
    public $newFileName;
    public $fileUploadName;
    public $sendSaveData;
    public $defNameInDB;
    public $thumNameInDB;  # thumPhoto_
    public $setCountOfUpload;

    public function __construct(
        $UploadDirIs = 'images/',
        $newFileName = null,
        $fileUploadName = 'image',
        $sendSaveData = array(),

        $defNameInDB = 'photo',
        $thumNameInDB = 'photo_thum_',
        $setCountOfUpload = '1',

    ) {
        $this->UploadDirIs = $UploadDirIs;
        $this->newFileName = $newFileName;
        $this->fileUploadName = $fileUploadName;
        $this->sendSaveData = $sendSaveData;

        $this->defNameInDB = $defNameInDB;
        $this->thumNameInDB = $thumNameInDB;
        $this->setCountOfUpload = $setCountOfUpload;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setfileUploadName
    public function setfileUploadName($setfileUploadName) {
        $this->fileUploadName = $setfileUploadName;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setnewFileName
    public function setCountOfUpload($setCountOfUpload) {
        $this->setCountOfUpload = $setCountOfUpload;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setnewFileName
    public function setnewFileName($newFileName) {
        $this->newFileName = $newFileName;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setUploadDirIs
    public function setUploadDirIs($UploadDirIs, $defFolder = 'images')   #,$defFolder = 'images/'
    {
        $UploadDirIs = trim($UploadDirIs);
        $lastLetter = substr($UploadDirIs, -1);
        $firstLetter = substr($UploadDirIs, 0, 1);

        if($lastLetter != '/') {
            $UploadDirIs = $UploadDirIs . '/';
        }
        if($firstLetter != '/') {
            $UploadDirIs = '/' . $UploadDirIs;
        }

        $fullPath = public_path($defFolder . $UploadDirIs);

        if(!File::isDirectory($fullPath)) {
            File::makeDirectory($fullPath, 0777, true, true);
        }
        $this->UploadDirIs = $defFolder . $UploadDirIs;

        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setUploadDirIs
    public function setFullsUploadDirIs($UploadDirIs) {
        $UploadDirIs = trim($UploadDirIs);
        $lastLetter = substr($UploadDirIs, -1);
        $firstLetter = substr($UploadDirIs, 0, 1);

        if($lastLetter != '/') {
            $UploadDirIs = $UploadDirIs . '/';
        }
        if($firstLetter != '/') {
            $UploadDirIs = '/' . $UploadDirIs;
        }

        $this->UploadDirIs = $UploadDirIs;

        return $this;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     mergeOldfilter
    static function mergeOldfilter($filterData, $newFilter) {

        if(intval($newFilter->get_add_text) == 1 and $filterData->text_state == 1) {
            $newFilter['text_state'] = $filterData->text_state;
            $newFilter['text_print'] = $filterData->text_print;
            $newFilter['font_size'] = $filterData->font_size;
            $newFilter['font_path'] = $filterData->font_path;
            $newFilter['font_color'] = $filterData->font_color;
            $newFilter['font_opacity'] = $filterData->font_opacity;
            $newFilter['text_position'] = $filterData->text_position;
        }

        if(intval($newFilter->get_more_option) == 1) {
            $newFilter['greyscale'] = $filterData->greyscale;
            $newFilter['flip_state'] = $filterData->flip_state;
            $newFilter['flip_v'] = $filterData->flip_v;

            if($filterData->blur_size > 0) {
                $newFilter['blur'] = $filterData->blur;
                $newFilter['blur_size'] = $filterData->blur_size;

            }
            if($filterData->pixelate_size > 0) {
                $newFilter['pixelate'] = $filterData->pixelate;
                $newFilter['pixelate_size'] = $filterData->pixelate_size;
            }
        }

        if(intval($newFilter->get_watermark) == 1 and $filterData->watermark_state == 1) {
            $newFilter['watermark_state'] = $filterData->watermark_state;
            $newFilter['watermark_img'] = $filterData->watermark_img;
            $newFilter['watermark_position'] = $filterData->watermark_position;
        }

        return $newFilter;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getFileExtension
    static function getFileExtension($file, $filterData) {
        $soursFileExtension = $file->extension();

        if(isset($filterData->convert_state) and $filterData->convert_state == 1) {
            $soursFileExtension = "webp";
        }
        return $soursFileExtension;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName
    static function getNewName($FileExtension, $newName, $UploadDirIs) {

        if($newName == null) {
            $newName = time() . "_" . Str::random(15) . "_" . '.' . $FileExtension;
        } else {
            // Str::random(10);
            $newName = AdminHelper::Url_Slug($newName) . "-" . Str::random(10) . '.' . $FileExtension;

        }
        $newName = AdminHelper::file_newname($UploadDirIs, $newName);
        return $newName;
    }
}

