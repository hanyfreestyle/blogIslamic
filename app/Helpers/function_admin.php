<?php


use App\AppCore\UploadFilter\Models\UploadFilter;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defAdminAssets
if (!function_exists('defAdminAssets')) {
    function defAdminAssets($path, $secure = null): string {
        return app('url')->asset('assets/admin/' . $path, $secure);
    }
}

if (!function_exists('defAdminPluginsAssets')) {
    function defAdminPluginsAssets($path, $secure = null): string {
        return app('url')->asset('assets/admin-plugins/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defImagesDir
if (!function_exists('defImagesDir')) {
    function defImagesDir($path, $secure = null): string {
        return app('url')->asset($path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    PdfAssets
if (!function_exists('PdfAssets')) {
    function PdfAssets($path, $secure = null): string {
        return app('url')->asset('assets/pdf/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    PdfAssets
if (!function_exists('flagAssets')) {
    function flagAssets($path, $secure = null): string {
        return app('url')->asset('assets/flag/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Update_createDirectory
if (!function_exists('Update_createDirectory')) {
    function Update_createDirectory($uploadDir) {
        $fullPath = $uploadDir;
        if (!File::isDirectory($fullPath)) {
            File::makeDirectory($fullPath, 0777, true, true);
        }
        return $uploadDir;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  IsMenuView
if (!function_exists('IsMenuView')) {
    function IsMenuView($Arr, $Name, $fileName = null, $DefVall = true) {
        if ($fileName != null) {
            $filePath = base_path('routes/AppPlugin/' . $fileName);

            if (!file_exists($filePath)) {
                $DefVall = false;
            }
        }
        if (isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  IsArr
if (!function_exists('IsArr')) {
    function IsArr($Arr, $Name, $DefVall = true) {
        if (isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  issetArr
if (!function_exists('issetArr')) {
    function issetArr($Arr, $Name, $DefVall = "") {
        if (isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   cashDay
if (!function_exists('cashDay')) {
    function cashDay($days = 2) {
        $lifeTime = $days * (86400);
        return $lifeTime;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    thisCurrentLocale
if (!function_exists('thisCurrentLocale')) {
    function thisCurrentLocale() {
        return LaravelLocalization::getCurrentLocale();
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName
if (!function_exists('getRoleName')) {
    function getRoleName() {
        if (thisCurrentLocale() == 'ar') {
            $sendName = "name_ar";
        } else {
            $sendName = "name_en";
        }
        return $sendName;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName
if (!function_exists('printLang')) {
    function printLang($sendLang) {
        $sendLang = str_replace("&amp;lt;br&amp;gt;", "\n", $sendLang);
        return nl2br($sendLang);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName
if (!function_exists('getColLang')) {
    function getColLang($crunt, $willBe = null) {
        if (count(config('app.web_lang')) >= 2) {
            $send = $crunt;
        } else {
            if ($willBe != null) {
                $send = $willBe;
            } else {
                $send = $crunt * 2;
            }
        }
        return $send;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printLableKey
if (!function_exists('printLableKey')) {
    function printLableKey($key) {
        if (count(config('app.web_lang')) > 1) {
            $send = '(' . $key . ')';
        } else {
            $send = "";
        }
        return $send;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DefCategoryTextName
if (!function_exists('DefCategoryTextName')) {
    function DefCategoryTextName($key) {
        if ($key) {
            $send = $key;
        } else {
            $send = __('admin/def.category_name');
        }
        return $send;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defAdminAssets
if (!function_exists('isSetKeyForLang')) {
    function isSetKeyForLang($key) {
        if (isset($_GET['key']) and $_GET['key'] == $key) {
            return "ThisSelectLang";
        } else {
            return '';
        }

    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # printCategoryName
if (!function_exists('printCategoryName')) {
    function printCategoryName($key, $row, $url) {

        if ($row->children_count > 0) {
            if (isset($row->translate($key)->name)) {
                return '<a href="' . route($url, $row->id) . '">' . $row->translate($key)->name . ' (' . $row->children_count . ')</a>';
            } else {
                return null;
            }
        } else {
            return $row->translate($key)->name ?? '';
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   printUploadNotes
if (!function_exists('printUploadNotes')) {
    function printUploadNotes($thisfilterid) {
        if (config('app.upload_photo_notes') == true and intval($thisfilterid) != 0) {
            $notesSend = UploadFilter::where('id', $thisfilterid)->first();
            $printName = "notes_" . thisCurrentLocale();
            return $notesSend->$printName ?? '';
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckDateFormat
if (!function_exists('CheckDateFormat')) {
    function CheckDateFormat($value) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $value)) {
            $dateValue = Carbon::parse($value)->format("Y-m-d");
        } else {
            $dateValue = $value;
        }
        return $dateValue;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   SaveDateFormat
if (!function_exists('SaveDateFormat')) {
    function SaveDateFormat($request, $name) {
        if ($request->input($name) == null) {
            $dateValue = Carbon::parse(now())->format("Y-m-d");
        } else {
            $dateValue = Carbon::parse($request->input($name))->format("Y-m-d");
        }
        return $dateValue;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
if (!function_exists('AdminActiveMenu')) {
    function AdminActiveMenu($SubMenu) {
        $SubMenus = explode('|', $SubMenu);
        foreach ($SubMenus as $SubMenu) {
//            if(Route::is('*.'. $SubMenu.'.*')){
//                return 'active';
//            }
            if (Route::is('*.' . $SubMenu)) {
                return 'active';
            }

        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
if (!function_exists('setActiveRoute')) {
    function setActiveRoute($main, $arrs = array()) {
        $defArr = ['index', 'create', 'edit', 'config', 'index_Main', 'SubCategory', 'CatSort', 'editEn', 'editAr', 'create_ar', 'create_en', 'filter'];
        $arrs = array_merge($defArr, $arrs);
        $line = "";
        foreach ($arrs as $arr) {
            $line .= $main . "." . $arr . "|";
        }
        return $line;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    puzzleMenu
if (!function_exists('puzzleMenu')) {
    function puzzleMenu($Route, $selRoute) {
        if ($selRoute == $Route) {
            return 'd';
        } else {
            return 'dark';
        }
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    RandomNumber
if (!function_exists('RandomNumber')) {
    function RandomNumber($Length = 9) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $Length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

if (!function_exists('ReportBlockPrint')) {
    function ReportBlockPrint($Col, $Titel, $Vall, $Icon = "", $Color = "bg-danger") {
        echo '<div class="' . $Col . ' report_widget">';
        echo '<div class="panel widget">';
        echo '<div class="row row-table row-flush">';
        if ($Icon) {
            echo '<div class="col-xs-4 ' . $Color . ' text-center">';
            echo '<em class="fa ' . $Icon . ' fa-2x"></em>';
            echo '</div>';
            $textCol = 'col-xs-8';
        } else {
            $textCol = 'col-xs-12';
        }
        echo '<div class="' . $textCol . '">';
        echo '<div class="panel-body text-center">';
        echo '<h4 class="mt0">' . $Vall . '</h4>';
        echo '<p class="mb0 text-muted">' . $Titel . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
if (!function_exists('GetChartVallFromArr_2022')) {
    function GetChartVallFromArr_2022($OldArr, $KeyFilter, $NameTabel_Arr, $SendArr = array()) {

        $findValueKey = issetArr($SendArr, "findValueKey", "id");
        $NamePrint = 'name';
        if (array_key_exists($KeyFilter, $OldArr[0])) {
            $OldArrAfterFilter = assc_array_count_values($OldArr, $KeyFilter);
            $EndArr = array();
            foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
                if ($Item_ID == '0') {
                    $NewVall = array('name' => "لا يوجد", 'count' => $Item_Count, 'id' => $Item_ID);
                } else {
                    $NewVall = array('name' => findValue_FromArr($NameTabel_Arr, $findValueKey, $Item_ID, $NamePrint), 'count' => $Item_Count, 'id' => $Item_ID);
                }
                array_push($EndArr, $NewVall);
            }
            $EndArr = array_sort($EndArr, 'count', SORT_DESC);
        }
        return $EndArr;
    }
}

if (!function_exists('assc_array_count_values')) {
    function assc_array_count_values($array, $key) {
        foreach ($array as $row) {
            $new_array[] = $row[$key];
        }
        #print_r3($new_array);
        return @array_count_values($new_array);
    }

}

if (!function_exists('array_sort')) {
    function array_sort($array, $on, $order = SORT_ASC) {
        $new_array = array();
        $sortable_array = array();
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }
            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }
            foreach ($sortable_array as $k => $v) {
                array_push($new_array, $array[$k]);
            }
        }
        return $new_array;
    }
}

if (!function_exists('findValue_FromArr')) {
    function findValue_FromArr($OldData,$Key,$Val,$SendName){
        if(count($OldData) > 0 and intval($Val)> '0' ){
            $hany = findValue($OldData, array($Key => $Val ), "0");
            if(!empty($hany)){
                $SendVall = $hany['0'][$SendName];
            }else{
                $SendVall = "";
            }
        }else{
            $SendVall  = "" ;
        }
        return $SendVall ;
    }
}
if (!function_exists('findValue')) {
    function findValue(array $array, array $parameters, $multipleResoult = false){
        $result = array();//used when $multipleResoult == true
        $suspicious = false;
        foreach($array as $childArray){
            foreach($parameters as $k => $p){
                if(array_key_exists($k,$childArray)){
                    if($childArray[$k] == $p){
                        $suspicious = $childArray;
                    } else {
                        $suspicious = false;
                        continue 2;
                    }
                } else {
                    $suspicious = false;
                    continue 2;
                }
            }
            if(is_array($suspicious)){
                $result[] = $suspicious;
                if($multipleResoult == true){
                    $suspicious = false;
                } else {
                    break;
                }
            }
        }
        return $result;
    }
}



if (!function_exists('dateDiff')) {
    function dateDiff($date) {
        $diff = Carbon::parse($date)->diffForHumans(Carbon::now());
        $thisDate = Carbon::parse($date)->format('d-m-Y');

        return $diff ." (".$thisDate.")"   ;
    }

}

if (!function_exists('printMetaDate')) {
    function printMetaDate($date) {
        $sendDate = Carbon::parse($date)->format('Y-m-d\TH:i:s\Z');
        return $sendDate ;
//        dd($diff);
    }
}







?>
