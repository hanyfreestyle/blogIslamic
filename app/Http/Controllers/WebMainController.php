<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Helpers\Seo\SchemaTools;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Jenssegers\Agent\Agent;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;


class WebMainController extends DefaultMainController {


    public $pageView;
    public $StopeCash = 0;

    public function __construct() {
        parent::__construct();
        $this->StopeCash = 0;


        $agent = new Agent();
        View::share('agent', $agent);

        $this->WebConfig = self::getWebConfig($this->StopeCash);
        View::share('WebConfig', $this->WebConfig);

        $this->DefPhotoList = self::getDefPhotoList($this->StopeCash);
        View::share('DefPhotoList', $this->DefPhotoList);

        $pageView = [
            'SelMenu' => '',
            'page' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home' => null,
            'profileMenu' => null,
        ];

        $this->pageView = $pageView;
        View::share('pageView', $pageView);

        $this->cssMinifyType = "Web"; # Web , WebMini , Seo
        View::share('cssMinifyType', $this->cssMinifyType);

        $this->cssReBuild = true;
        View::share('cssReBuild', $this->cssReBuild);

        $this->printSchema = new SchemaTools();
        View::share('printSchema', $this->printSchema);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printSeoMeta
    public function printSeoMeta($row, $route = null, $defPhoto = "logo", $sendArr = array()) {
        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $lang = thisCurrentLocale();
            $type = AdminHelper::arrIsset($sendArr, 'type', 'website');
            $ErrorPage = AdminHelper::arrIsset($sendArr, 'ErrorPage', false);

            if (isset($row->photo)) {
                $defImage = $row->photo;
            } else {
                $GetdefImage = self::getDefPhotoById($defPhoto);
                $defImage = optional($GetdefImage)->photo;
            }
            if ($defImage) {
                $defImage = defImagesDir($defImage);
            }

            $TitleInfo = self::TitleInfo($row, $route, $sendArr);
            $setTitle = $TitleInfo['Title'];
            $setDescription = $TitleInfo['Description'];


            SEOMeta::setTitle($setTitle);
            SEOMeta::setDescription($setDescription);


            if ($ErrorPage != true) {

                if ($route == 'AuthorView') {
                    OpenGraph::setDescription($row->name ?? "");
                } else {
                    OpenGraph::setDescription($setDescription ?? "");
                }

                self::Urlinfo($row, $route);
                OpenGraph::setTitle($setTitle);

                OpenGraph::addProperty('type', $type);
                OpenGraph::setUrl(urldecode(url()->current()));
                OpenGraph::addImage($defImage);
                OpenGraph::setSiteName($this->WebConfig->name);

                TwitterCard::setTitle($setTitle);
                TwitterCard::setDescription($setDescription);
                TwitterCard::setUrl(urldecode(url()->current()));
                TwitterCard::setImage($defImage);
                TwitterCard::setImage($defImage);
                TwitterCard::setType('summary_large_image');
            }
        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TitleInfo($row, $route, $sendArr) {


        if ($this->WebConfig->meta_des) {
            $siteName = $this->WebConfig->meta_des;
        } else {
            $siteName = null;
        }

        switch ($route) {
            case 'CategoryView':
                $setTitle = self::CheckMeta($row, 'g_title', 'name') . " " . $siteName;
                $setDescription = self::CheckMeta($row, 'g_des', 'des');
                $xx = "1";
                break;

            case 'blog_view':
                $setTitle = self::CheckMeta($row, 'g_title', 'name') . " " . $siteName;
                $setDescription = self::CheckMeta($row, 'g_des', 'des');
                $xx = "2";
                break;

            case 'TagView':
                $setTitle = self::CheckMeta($row, 'name', 'name') . " " . $siteName;
                $setDescription = self::CheckMeta($row, 'name', 'name') . " " . $siteName;
                $xx = "3";
                break;

            case 'AuthorView':
                $setTitle = self::CheckMeta($row, 'name', 'name')  . " " . $siteName;
                $setDescription = self::CheckMeta($row, 'name', 'name')  . " " . $siteName;
                $xx = "4";
                break;

            default:
                $setTitle = ($row->g_title ?? $row->name);
                $setDescription = ($row->g_des ?? $row->name);


        }

        $WebConfig = WebMainController::getWebConfig();
        $SiteName = $WebConfig->name . " | ";

        $rep1 = array("%SiteName%");
        $rep2 = array($SiteName);
        $setTitle = str_replace($rep1, $rep2, $setTitle);
        $setDescription = str_replace($rep1, $rep2, $setDescription);

        return ['Title' => $setTitle, 'Description' => $setDescription];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    Urlinfo
    static function Urlinfo($row, $route) {
        $lang = thisCurrentLocale();
        $alternatUrl = null;
        $pages = null;

        if ($lang == 'en') {
            $alternateLang = 'ar';
        } elseif ($lang == 'ar') {
            $alternateLang = 'en';
        }

        if (isset($_GET['page'])) {
            $pages = "page=" . $_GET['page'];
        }

        switch ($route) {

            case 'CategoryView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('CategoryView', $row->slug)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('CategoryView', $row->slug)));
                break;

            case 'blog_view':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('blog_view', $row->slug)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('blog_view', $row->slug)));
                break;

            case 'TagView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('TagView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('TagView', [$row->slug, $pages])));
                break;

            case 'AuthorView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('AuthorView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('AuthorView', [$row->slug, $pages])));
                break;


            default:
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route($route, $pages)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route($route, $pages)));
                break;

        }

        if ($route != null) {
            SEOMeta::addAlternateLanguage($lang, $Url);
            if ($alternatUrl != null and count(config('app.web_lang')) > 1) {
                SEOMeta::addAlternateLanguage($alternateLang, $alternatUrl);
            }
            SEOMeta::setCanonical($Url);
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckMeta
    public function CheckMeta($row, $def, $other) {
        if ($row->$def == null) {
            $meta = AdminHelper::seoDesClean($row->$other);
        } else {
            $meta = $row->$def;
        }
        return $meta;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function abortError404($from = "root") {

        $Meta = DefaultMainController::getMeatByCatId('err_404');

        WebMainController::printSeoMeta($Meta, null, null, array('ErrorPage' => true));
        $pageView = [
            'SelMenu' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home' => route('page_index'),
        ];
        View::share('pageView', $pageView);
        View::share('meta', $Meta);

        $adminDir = config('app.configAdminDir');
        $currentSlug = Route::current()->originalParameters();

        if (isset($currentSlug['slug']) and mb_substr($currentSlug['slug'], 0, strlen($adminDir)) == $adminDir) {
            abort('410');
        } else {
            abort('404');
        }

    }


}
