<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('sidebarCollapse')) {
    function sidebarCollapse() {
        $session = Session::get('sidebarCollapse');
        if ($session == null) {
            if (config('app.SideBarCollapse')) {
                $state = " sidebar-collapse sidebar-mini ";
            } else {
                $state = null;
            }
        }else{
            $state =  $session ;
        }
        return $state;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('sidebarCollapseIcon')) {
    function sidebarCollapseIcon() {
        $session = Session::get('sidebarCollapse');
        if ($session == null) {
            $icon = '<i class="fas fa-compress-arrows-alt"></i>';
        }else{
            $icon =  '<i class="fas fa-compress"></i>';
        }
        return $icon;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    TablePhoto
if (!function_exists('TablePhoto')) {
    function TablePhoto($row, $fildeName = 'photo_thum_1') {
        if ($row->$fildeName) {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defImagesDir($row->$fildeName) . '">';
        } else {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defAdminAssets('img/default-150x150.png') . '">';
        }
        return $sendImg;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    TablePhotoFlag
if (!function_exists('TablePhotoFlag')) {
    function TablePhotoFlag($row, $fildeName = 'photo_thum_1') {
        if ($row->$fildeName) {
            $sendImg = '<img  class="tableImg cust_country img-rounded" src="' . flagAssets($row->$fildeName) . '">';
        } else {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defAdminAssets('img/default-150x150.png') . '">';
        }
        return $sendImg;
    }
}

if (!function_exists('TablePhotoFlag_Code')) {
    function TablePhotoFlag_Code($row, $fildeName = 'photo_thum_1') {
        if ($row->$fildeName) {
            $sendImg = '<img  class="tableImg cust_country img-rounded" src="' . flagAssets("120/" . $row->$fildeName) . '.webp">';
        } else {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defAdminAssets('img/default-150x150.png') . '">';
        }
        return $sendImg;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    UserProfilePhoto
if (!function_exists('UserProfilePhoto')) {
    function UserProfilePhoto($fildeName = 'photo_thum_1') {
        if (Auth::user()->$fildeName) {
            $sendImg = defImagesDir(Auth::user()->$fildeName);
        } else {
            $sendImg = defAdminAssets('img/user_avatar.jpg');
        }
        return $sendImg;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # mainBodyStyle
if (!function_exists('mainBodyStyle')) {
    function mainBodyStyle() {
        $sendStyle = "sidebar-mini ";
        if (config('adminConfig.sidebar_collapse_hide') == true) {
            $sendStyle = ' ';
        }
        if (config('adminConfig.sidebar_collapse') == true) {
            $sendStyle .= ' sidebar-collapse ';
        }
        if (config('adminConfig.sidebar_fixed') == true) {
            $sendStyle .= ' layout-fixed ';
        }
        if (config('adminConfig.top_navbar_fixed') == true) {
            $sendStyle .= ' layout-navbar-fixed ';
        }
        if (config('adminConfig.footer_fixed') == true) {
            $sendStyle .= ' layout-footer-fixed ';
        }
        if (config('adminConfig.dark-mode') == true) {
            $sendStyle .= ' dark-mode ';
        }
        if (config('adminConfig.pace_progress') == true) {
            $sendStyle .= ' ' . config('adminConfig.pace_progress_style') . ' ';
        }

        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # htmlArDir
if (!function_exists('htmlArDir')) {
    function htmlArDir() {
        $sendStyle = ' dir="' . LaravelLocalization::getCurrentLocaleDirection() . '" ';
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # sideBarNavUlStyle
if (!function_exists('navBarStyle')) {
    function navBarStyle() {
        $sendStyle = " navbar-white ";
        if (config('adminConfig.top_navbar_dark') == true or config('adminConfig.dark-mode') == true) {
            $sendStyle = ' navbar-dark ';
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # sideBarNavUlStyle
if (!function_exists('sideBarNavUlStyle')) {
    function sideBarNavUlStyle() {
        $sendStyle = " ";
        if (config('adminConfig.sidebar_flat_style') == true) {
            $sendStyle = ' nav-flat ';
        }
        return $sendStyle;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getButSize
if (!function_exists('getButSize')) {
    function getButSize($val) {
        switch ($val) {
            case 's':
                $sendStyle = "btn-sm";
                break;
            case 'm':
                $sendStyle = "btn-md";
                break;
            case 'l':
                $sendStyle = "btn-lg";
                break;

            default:
                $sendStyle = "btn-sm";
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getBgColor
if (!function_exists('getBgColor')) {
    function getBgColor($val) {
        switch ($val) {
            case 'def':
                $sendColor = "default";
                break;
            case 'dark':
                $sendColor = "dark";
                break;
            case 'p':
                $sendColor = "primary";
                break;
            case 'se':
                $sendColor = "secondary";
                break;
            case 's':
                $sendColor = "success";
                break;
            case 'i':
                $sendColor = "info";
                break;
            case 'd':
                $sendColor = "danger";
                break;
            case 'w':
                $sendColor = "warning";
                break;
            case 'l':
                $sendColor = "light";
                break;
            default:
                $sendColor = "dark";
        }
        return $sendColor;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getAlign
if (!function_exists('getAlign')) {
    function getAlign($val) {
        $sendStyle = "";
        if ($val == 'c') {
            $sendStyle = "center";
        } elseif ($val == 'r') {
            $sendStyle = "right";
        } elseif ($val == 'l') {
            $sendStyle = "left";
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getColDir
if (!function_exists('getColDir')) {
    function getColDir($key, $sendArr = array()) {
        $currentDir = "";
        if ($key == 'ar' and thisCurrentLocale() == 'en') {
            $currentDir = ' order-last ';
        }
        return $currentDir;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     is_active
if (!function_exists('is_active')) {
    function is_active($is_active) {
        if ($is_active == 1) {
            $icon = '<img width="25" src="' . defAdminAssets('img/active.webp') . '">';
        } else {
            $icon = '<img width="25" src="' . defAdminAssets('img/active_un.webp') . '">';
        }
        return $icon;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   print_h1
if (!function_exists('print_h1')) {
    function print_h1($row, $name = 'name') {
        $app_lang = LaravelLocalization::getCurrentLocale();
        if ($app_lang == 'ar') {
            $changeLang = "en";
        } else {
            $changeLang = "ar";
        }
        return $row->translate($app_lang)->$name ?? $row->translate($changeLang)->$name ?? '';
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     echobr
if (!function_exists('echobr')) {
    function echobr($text = "") {
        if ($text == "hr") {
            $text = '<hr/>';
        }
        echo $text . "<br/>";
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Table_Header_Style
if (!function_exists('Table_Style')) {
    function Table_Style($viewDataTable, $yajraTable = false) {
        if ($viewDataTable) {
            if ($yajraTable) {
                $tableHeader = ' id="" class="table table-bordered table-hover DataTableView" ';
            } else {
                $tableHeader = ' id="MainDataTable" class="table table-bordered table-hover" ';
            }
        } else {
            $tableHeader = ' class="table table-hover" ';
        }
        return $tableHeader;
    }
}



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #



