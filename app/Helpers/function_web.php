<?php

use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defWebAssets
if(!function_exists('defWebAssets')) {
    function defWebAssets($path, $secure = null): string {
        return app('url')->asset('assets/web/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    underAssets
if(!function_exists('underAssets')) {
    function underAssets($path, $secure = null): string {
        return app('url')->asset('assets/under/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getPhotoPath
if(!function_exists('getPhotoPath')) {
    function getPhotoPath($file, $defPhoto = "dark_logo", $defPhotoThum = "photo") {
        $defPhoto_file = WebMainController::getDefPhotoById($defPhoto);
        if($file) {
            $sendImg = defImagesDir($file);
        } else {
            $sendImg = defImagesDir($defPhoto_file->$defPhotoThum ?? '');
        }
        return $sendImg;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    getDefPhotoPath
if(!function_exists('getDefPhotoPath')) {
    function getDefPhotoPath($DefPhotoList, $cat_id, $defPhotoThum = "photo") {
        if($DefPhotoList->has($cat_id)) {
            $file = $DefPhotoList[$cat_id][$defPhotoThum];
            $sendImg = defImagesDir($file);
        } else {
            $sendImg = "";
        }
        return $sendImg;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webChangeLocale
if(!function_exists('webChangeLocale')) {
    function webChangeLocale() {
        $Current = LaravelLocalization::getCurrentLocale();
        if($Current == 'ar') {
            $change = 'en';
        } else {
            $change = 'ar';
        }
        return $change;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webChangeLocaletext
if(!function_exists('webChangeLocaletext')) {
    function webChangeLocaletext() {
        $Current = LaravelLocalization::getCurrentLocale();
        if($Current == 'ar') {
            $change = 'English';
        } else {
            $change = 'عربى';
        }
        return $change;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     GetCopyRight
if(!function_exists('GetCopyRight')) {
    function GetCopyRight($StartDate, $CompanyName) {
        if($StartDate > date("Y")) {
            $StartDate = date("Y");
        }
        $Lang = LaravelLocalization::getCurrentLocale();
        switch ($Lang) {
            case 'ar':
                $copyname = "جميع الحقوق محفوظة";
                if($StartDate == date("Y")) {
                    $CopyRight = $copyname . " &copy; " . date("Y") . ' <span class="clr-tertiary-300">' . $CompanyName . '</span>';
                } else {
                    $CopyRight = $copyname . '<span class="En_Font footerYears">' . " &copy; " . $StartDate . " - " . date("Y")
                        . '</span> <span class="clr-tertiary-300">' . $CompanyName . '</span>';
                }
                break;
            default:
                $copyname = "All Rights Reserved";
                if($StartDate == date("Y")) {
                    $CopyRight = $copyname . " &copy; " . date("Y") . ' <span class="clr-tertiary-300">' . $CompanyName . '</span>';
                } else {
                    $CopyRight = $copyname . " &copy; " . $StartDate . " - " . date("Y") . ' <span class="clr-tertiary-300">'
                        . $CompanyName . '</span>';
                }
        }
        return $CopyRight;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ChangeText
if(!function_exists('ChangeText')) {
    function ChangeText($value) {
        $WebConfig = WebMainController::getWebConfig();
        $CompanyName = '<span>' . $WebConfig->name . '</span>';
        $webEmail = '<span>' . $WebConfig->email . '</span>';
        $def_url = '<span>' . $WebConfig->def_url . '</span>';
        $rep1 = array("[CompanyName]", "[WebSiteName]", "[WebEmail]");
        $rep2 = array($CompanyName, $def_url, $webEmail);
        $value = str_replace($rep1, $rep2, $value);
        return $value;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     activeMenu
if(!function_exists('activeMenu')) {
    function activeMenu($pageView, $selMenu) {
        if($pageView['SelMenu'] == $selMenu) {
            $setActive = 'setActive';
        } else {
            $setActive = '';
        }
        return $setActive;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     activeProfileMenu
if(!function_exists('activeProfileMenu')) {
    function activeProfileMenu($pageView, $selMenu) {
        if(isset($pageView['profileMenu'])){
            if($pageView['profileMenu'] == $selMenu) {
                $setActive = 'setActive';
            } else {
                $setActive = '';
            }
        }else{
            $setActive = '';
        }

        return $setActive;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     htmlLangInfo
if(!function_exists('htmlLangInfo')) {
    function htmlLangInfo($getVall = "all") {
        $current = LaravelLocalization::getCurrentLocale();
        if($current == 'ar') {

        } elseif($current == 'en') {

        } else {

        }

        $data = [

        ];


        return $data;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  htmlBodyStyle
if(!function_exists('htmlBodyStyle')) {
    function htmlBodyStyle($pageView) {
        $current = LaravelLocalization::getCurrentLocale();
        if($current == 'ar') {
            $dir = ' rtl ';
        } else {
            $dir = ' ltr ';
        }
        $value = issetArr($pageView, "page", '404');
        switch ($value) {

            case 'page_index':
                $sendStyle = " lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-index cart_pos_side kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_sticky_true des_header_3 h_banner_true top_bar_true prs_bordered_grid_1 search_pos_full lazyload ";
                break;

            case 'BlogPostList':
                $sendStyle = ' header_full_true kalles-template css_scrollbar lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true header_sticky_true hide_scrolld_true des_header_3 h_banner_true top_bar_true prs_bordered_grid_1 search_pos_canvas lazyload';
                break;

            case 'SinglePost':
                $sendStyle = ' kalles-template single-product-template zoom_tp_2 des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';
                $sendStyle = ' kalles-template single-product-template zoom_tp_2 des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';
                $sendStyle = '';
                break;
            case 'BrandView':
                $sendStyle = 'kalles-template single-product-template zoom_tp_2 header_full_true des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';
                $sendStyle = '';
                break;

            case 'Hany':
                $sendStyle = 'kalles-template single-product-template zoom_tp_2 header_full_true des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';;
                break;


            case 'cart_page':
                $sendStyle = 'des_header_3 css_scrollbar lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-cart kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded hide_scrolld_true lazyload';
                break;


            default:
                $sendStyle = "";
        }
//        dd($sendStyle);

        return $dir . "label_style_rounded " . $sendStyle;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     productSlugForCart
    if(!function_exists('productSlugForCart')) {
        function productSlugForCart($product) {
            $slug = "#";
            if($product->model->parent_id == null){
                $slug = route('ProductView',$product->model->slug);
            }else{
                $slug = route('ProductView',$product->model->mainPro->slug);
            }
            return $slug;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     productPhotoForCart
    if(!function_exists('productPhotoForCart')) {
        function productPhotoForCart($product) {

            if($product->model->parent_id == null){
                $photo = getPhotoPath($product->model->photo_thum_1,"product","photo");
            }else{
                $photo = getPhotoPath($product->model->mainPro->photo_thum_1,"product","photo");
            }
            return $photo;
        }
    }

    if (!function_exists('PrintShortDes')) {
        function PrintShortDes($row,$limit=160) {
            if($row->g_des == null){

                $value =  AdminHelper::seoDesClean($row->des,$limit);
            }else{
                $value =  $row->g_des ;
            }

            return $value;
        }
    }

    if (!function_exists('CleanBlogDes')) {
        function CleanBlogDes($des) {
//dd($des);

//            $des = preg_replace("/<p[^>]*><\\/p[^>]*>/", '', $des);
//             $des = str_replace("<p></p>", '', $des);
//            $des = str_replace("<img", '<p>ddddddddddddddddd</p>', $des);

//            $des = preg_replace('/\[.*?\]/', '', $des);
//            $des = preg_replace('#\s*\[caption[^]]*\].*?\[/caption\]\s*#is', '', $des);

//            $des =  preg_replace('/.*(<img[^>]+)>.*/', '$1', $des);
//            $descleane =  preg_replace('%(\[caption\b[^\]]*\](.*?)(\[\/caption]))%', '$2', $descleane);
//             $des = str_replace( '<br/>', "<p>\n</p>", nl2br($des) );
            return $des;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    if (!function_exists('printBlogName')) {
        function printBlogName($name) {
            $name = explode(" ", $name);
            $newLine = '';
            foreach ($name as $newName) {
                if (mb_substr($newName, 0, 3) == 'الا') {
                    $offset = '<span>' . mb_substr($newName, 0, 3) . '</span>';
                    $offset_after = mb_substr($newName, 3, 2000);
                    $line = $offset . $offset_after;
                }elseif (mb_substr($newName, 0, 2) == 'لا' or  mb_substr($newName, 0, 2) == 'ال'){
                    $offset = '<span>' . mb_substr($newName, 0, 2) . '</span>';
                    $offset_after = mb_substr($newName, 2, 2000);
                    $line = $offset . $offset_after;
                } else {
                    $offset = '<span>'.mb_substr($newName, 0, 1).'</span>';
                    $offset_after =  mb_substr($newName, 1, 2000);
                    $line = $offset .$offset_after  ;
                }
                $newLine .= $line . " ";
            }
            return $newLine;
        }
    }

}
