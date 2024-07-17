<?php

namespace App\Helpers\photoUpload;


use App\Helpers\AdminHelper;
use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;





class AdminImageUpload  {



    static function UploadOne($request,$sendArr=array())
    {
        $saveData = [];

        $saveDirIs = AdminHelper::arrIsset($sendArr,'saveDirIs','uploads/album/');
        $fileName = AdminHelper::arrIsset($sendArr,'fileName','image');

        $filter_Id = AdminHelper::arrIsset($sendArr,'filter_id',$request->filter_id);



        if (request()->hasFile($fileName)) {

            // مكان الحفظ
            // $saveDirIs = AdminImageUpload::createDirectory($saveDirIs);
            $saveDirIs = self::createDirectory($saveDirIs);

            /// بيانات الفلتر
            $filterData = UploadFilter::find($filter_Id);
           // $fffff = $filterData->toArray();

            // بيانات الصور الاضافيه
            $filterSizeData = UploadFilterSize::where('filter_id',$filter_Id)->get();

            /// بيانات الملف المرفوع
            $file = $request->file($fileName);

            $FileExtension = self::getFileExtension($file,$filterData);


            /// الصورة الاصلية
            $saveImage =  Image::make($file);


            $newName = self::getNewName($FileExtension,$saveDirIs,$request,$sendArr);



            //$saveImage->filter(new ImageFilters($request->filter_id));
            $saveImage->filter(new ImageFilters($filterData));

            $saveImage->save(public_path($saveDirIs.$newName), $filterData->quality_val, $FileExtension);


            $saveData = [
                'defPhoto' => [
                    "file_original_name"=>$saveImage->filename,
                    "file_name"=>$saveDirIs.$saveImage->basename,
                    "extension"=>$saveImage->extension,
                    "type"=>"image",
                ],
            ];




            if(count($filterSizeData) > 0){
                $index = 1;
                foreach ($filterSizeData as $newFilter ){

                    $newFilter =  self::mergeOldfilter($filterData,$newFilter);


                    /// dd($newFilter);
                    $saveImage =  Image::make($file);
                    $newName = self::getNewName($FileExtension,$saveDirIs,$request,$sendArr);


                    //dd($newFilter);

                    $saveImage->filter(new ImageFilters($newFilter));

                    $saveImage->save(public_path($saveDirIs.$newName), $filterData->quality_val, $FileExtension);

                    $saveData += [
                        'thumPhoto_'.$index => [
                            "file_original_name"=>$saveImage->filename,
                            "file_name"=>$saveDirIs.$saveImage->basename,
                            "extension"=>$saveImage->extension,
                            "type"=>"image",
                        ],
                    ];

                    $index++;
                }

            }

        }else{
            dd('No Photo');
        }
        return $saveData;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    static function mergeOldfilter($filterData,$newFilter){

        if(intval($newFilter->get_add_text) == 1 and $filterData->text_state == 1){
            $newFilter['text_state'] = $filterData->text_state;
            $newFilter['text_print'] = $filterData->text_print;
            $newFilter['font_size'] = $filterData->font_size;
            $newFilter['font_path'] = $filterData->font_path;
            $newFilter['font_color'] = $filterData->font_color;
            $newFilter['font_opacity'] = $filterData->font_opacity;
            $newFilter['text_position'] = $filterData->text_position;
        }

        if(intval($newFilter->get_more_option) == 1){
            $newFilter['greyscale'] = $filterData->greyscale;
            $newFilter['flip_state'] = $filterData->flip_state;
            $newFilter['flip_v'] = $filterData->flip_v;

            if($filterData->blur_size > 0){
                $newFilter['blur'] = $filterData->blur;
                $newFilter['blur_size'] = $filterData->blur_size;

            }
            if($filterData->pixelate_size > 0){
                $newFilter['pixelate'] = $filterData->pixelate;
                $newFilter['pixelate_size'] = $filterData->pixelate_size;
            }
        }

        if(intval($newFilter->get_watermark) == 1 and $filterData->watermark_state == 1 ){
            $newFilter['watermark_state'] = $filterData->watermark_state;
            $newFilter['watermark_img'] = $filterData->watermark_img;
            $newFilter['watermark_position'] = $filterData->watermark_position;
        }

        return $newFilter;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     createDirectory
    static function createDirectory($uploadDir)
    {
        $fullPath = public_path($uploadDir);
        if(!File::isDirectory($fullPath)){
            File::makeDirectory($fullPath, 0777, true, true);
        }
        return $uploadDir ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getFileExtension
    static function getFileExtension($file,$filterData)
    {
        $soursFileExtension = $file->extension();

        if( $filterData->convert_state == '1'){
            $soursFileExtension = "webp";
        }
        return $soursFileExtension ;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName
    static function getNewName($FileExtension,$saveDirIs,$request,$sendArr=array()){

        $newName = AdminHelper::arrIsset($sendArr,'newName','');

        if($newName == ''){
            $newName = time()."_".Str::random(15)."_".'.'.$FileExtension;
        }else{
            // Str::random(10);
            $newName = AdminHelper::Url_Slug($newName).'.'.$FileExtension;
        }

        $newName =  AdminHelper::file_newname($saveDirIs,$newName);

        return $newName ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName

}
