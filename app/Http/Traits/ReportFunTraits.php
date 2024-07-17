<?php

namespace App\Http\Traits;


use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use mysql_xdevapi\Collection;

trait ReportFunTraits {

    use DefCategoryTraits;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromModel($AllData, $Model, $selectDataId, $limit = 15) {

        $selectDataIdKey = array_keys($selectDataId);

        $getSoursData = $Model::query()->where('is_active', true)
            ->with('translation')
            ->whereIn('id', $selectDataIdKey)
            ->get();

        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromGroup($AllData, $selectDataId,$addName = null, $limit = 20) {
        $sendArr = self::LoopForGetDataSoft($AllData, $selectDataId,$addName, $limit);
        return $sendArr;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function  LoopForGetDataSoft($AllData, $selectDataId,$addName, $limit) {
        $countAllData = $AllData;
        $sendArr = [];
        $countData = 0;
        $other_count = 0;
        $start = 0;

        unset($selectDataId['']);

        foreach ($selectDataId as $key => $value) {
            $persent = round((count($value) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . count($value) . ") " .$addName ." ". $key . " " . $persent,
                'count' => count($value)
            ];
            $countData = $countData + count($value);
            array_push($sendArr, $arr);
        }

        $sendArr = array_sort($sendArr, 'count', SORT_DESC);

        if (count($sendArr) > $limit) {
            foreach ($sendArr as $key => $value) {
                if ($start >= $limit) {
                    unset($sendArr[$key]);
                    $other_count = $other_count + $value['count'];
                }
                $start = $start + 1;
            }
        }

        if ($other_count > 0) {
            $persent = round(($other_count / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $other_count . ") " . __('admin/def.report_other') . " " . $persent,
                'count' => $other_count,
                'setColor' => "#FF6600"
            ];
            array_push($sendArr, $arr);
        }


        if ($countData < $AllData) {

            $persent = round((($AllData - $countData) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $AllData - $countData . ") " . __('admin/def.report_undefined') . " " . $persent,
                'count' => $AllData - $countData,
                'setColor' => "#FF0000"
            ];
            array_push($sendArr, $arr);
        }


        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromDataConfig($AllData, $CatId, $selectDataId, $limit = 15) {
        $selectDataIdKey = array_keys($selectDataId);

        $getSoursData = ConfigData::query()
            ->where('cat_id', $CatId)
            ->whereIn('id', $selectDataIdKey)
            ->with('translation')
            ->get();

        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ChartDataFromDefCategory
    public function ChartDataFromDefCategory($AllData, $CatId, $selectDataId, $limit = 15) {
        $selectDataIdKey = array_keys($selectDataId);
        $getLoadCategory = self::LoadCategory();
        $getSoursData = issetArr($getLoadCategory, $CatId, array());
        $getSoursData = collect($getSoursData);
        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function  LoopForGetData($AllData, $getSoursData, $selectDataId, $limit) {
        $countAllData = $AllData;
        $sendArr = [];
        $countData = 0;
        $other_count = 0;
        $start = 0;

        unset($selectDataId['']);

        foreach ($selectDataId as $key => $value) {

            $name = $getSoursData->where('id', $key)->first()->name ?? '' ;

            $persent = round((count($value) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . count($value) . ") " . $name . " " . $persent,
                'count' => count($value)
            ];

            $countData = $countData + count($value);
            array_push($sendArr, $arr);
        }

        $sendArr = array_sort($sendArr, 'count', SORT_DESC);

        if (count($sendArr) > $limit) {
            foreach ($sendArr as $key => $value) {
                if ($start >= $limit) {
                    unset($sendArr[$key]);
                    $other_count = $other_count + $value['count'];
                }
                $start = $start + 1;
            }
        }

        if ($other_count > 0) {
            $persent = round(($other_count / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $other_count . ") " . __('admin/def.report_other') . " " . $persent,
                'count' => $other_count,
                'setColor' => "#FF6600"
            ];
            array_push($sendArr, $arr);
        }


        if ($countData < $AllData) {

            $persent = round((($AllData - $countData) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $AllData - $countData . ") " . __('admin/def.report_undefined') . " " . $persent,
                'count' => $AllData - $countData,
                'setColor' => "#FF0000"
            ];
            array_push($sendArr, $arr);
        }


        return $sendArr;
    }



}
