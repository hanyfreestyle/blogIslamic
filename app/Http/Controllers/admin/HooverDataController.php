<?php

namespace App\Http\Controllers\admin;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\DB;


class HooverDataController extends AdminMainController {

    public function getConfigData() {
        $LeadCategory = ConfigData::where('cat_id', 'LeadCategory')->count();
        if ($LeadCategory == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_lead_cat')->get();
            self::SaveData('LeadCategory', $oldData);
        }

        $LeadSours = ConfigData::where('cat_id', 'LeadSours')->count();
        if ($LeadSours == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_lead_sours')->get();
            self::SaveData('LeadSours', $oldData);
        }


        $BrandName = ConfigData::where('cat_id', 'BrandName')->count();
        if ($BrandName == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_brand')->get();
            self::SaveData('BrandName', $oldData);
        }

        $DeviceType = ConfigData::where('cat_id', 'DeviceType')->count();
        if ($DeviceType == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_device_type')->get();
            self::SaveData('DeviceType', $oldData);
        }

        $Areas = Area::count();
        if ($Areas == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_area')->get();
            self::SaveDataArea($oldData);
        }




    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   SaveData
    static function SaveDataArea($oldData) {
        if (count($oldData) != 0) {
            foreach ($oldData as $data) {
                $saveData = new Area();
                $saveData->old_id = $data->id;
                $saveData->country_id = 66;

                if($data->pro_id == 189){
                    $cityId = 10 ;
                }elseif ($data->pro_id == 175){
                    $cityId = 4 ;
                }elseif ($data->pro_id == 176){
                    $cityId = 1 ;
                }
                $saveData->city_id = $cityId;
                $saveData->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = AreaTranslation::where('area_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->area_id = $saveData->id;
                    if ($key == 'ar') {
                        $PrintName = "name";
                    } else {
                        $PrintName = "name_en";
                    }

                    $saveTranslation->name = $data->$PrintName;
                    $saveTranslation->save();
                }
            }
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   SaveData
    static function SaveData($cat_id, $oldData) {
        if (count($oldData) != 0) {
            foreach ($oldData as $data) {
                $saveData = new ConfigData();
                $saveData->old_id = $data->id;
                $saveData->cat_id = $cat_id;
                $saveData->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = ConfigDataTranslation::where('data_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->data_id = $saveData->id;
                    if ($key == 'ar') {
                        $PrintName = "name";
                    } else {
                        $PrintName = "name_en";
                    }

                    $saveTranslation->name = $data->$PrintName;
                    $saveTranslation->save();
                }
            }
        }
    }
}
