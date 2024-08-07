<?php

namespace App\AppPlugin\Config\SiteMap;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class SiteMapController extends AdminMainController {
    function __construct() {

        parent::__construct();
        $this->controllerName = "SiteMap";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = 'Site Maps';
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, 'selectfilterid' => 0, "orderby" => 0],
            'yajraTable' => true,
            'AddButToCard' => false,
            'restore' => 1,
            'formName' => "ShopOrdersFilters",
        ];


        $this->config = [
            'singlePage' => true,
            'addAlternate' => false,
            'addPhoto' => true,
            'langAr' => true,
            'langEn' => false,
        ];
        View::share('Config', $this->config);


        self::loadConstructData($sendArr);

        $this->middleware('permission:sitemap_view', ['only' => ['index']]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # index
    public function index() {
        $rowData = SiteMap::get();
        return view('AppPlugin.ConfigSiteMap.index')->with([
            'rowData' => $rowData
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateSiteMap() {
        SiteMap::query()->truncate();
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', false);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);

        if ($this->config['singlePage']) {
            $xmlFileName = public_path('sitemap.xml');
            $fh = fopen($xmlFileName, 'w') or die("can't open file");
            $stringData = $siteMapTools->XML_HeaderSinglePage();
        } else {
            $stringData = "";
        }

        $stringData .= self::UpdateIndexPages('index');
        $stringData .= self::UpdateBlogPages('blog');

        if ($this->config['singlePage']) {
            $stringData .= "</urlset>\n";
            fwrite($fh, $stringData);
            fclose($fh);
        }

        SiteMapTools::updateIndexSiteMapXmlFile($this->config['singlePage']);
        return redirect()->back();
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateIndexPages($catId) {
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', false);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);
        $urlCount = 0;

        if (!$this->config['singlePage']) {
            $xmlFileName = public_path("sitemap." . $catId . ".xml");
            $fh = fopen($xmlFileName, 'w') or die("can't open file");
            $stringData = $siteMapTools->XML_Header();
        } else {
            $stringData = "";
        }

        $routes = ['page_index', 'PageReview', 'PageAbout', 'PagePrivacy'];

        foreach (config('app.web_lang') as $key => $lang) {
            foreach ($routes as $route) {
                $stringData .= $siteMapTools->AddSinglePage($key, $route);
            }
            $urlCount = $urlCount + count($routes);
        }

        SiteMapTools::updateIndexSiteOneFile($catId, $urlCount);

        if (!$this->config['singlePage']) {
            $stringData .= "</urlset>\n";
            fwrite($fh, $stringData);
            fclose($fh);
        } else {
            return $stringData;
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateBlogPages($catId) {
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', true);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);
        $urlCount = 0;
        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {

            if (!$this->config['singlePage']) {
                $xmlFileName = public_path("sitemap." . $catId . ".xml");
                $fh = fopen($xmlFileName, 'w') or die("can't open file");
                $stringData = $siteMapTools->XML_Header();
            } else {
                $stringData = "";
            }

            $dataRows = BlogCategory::orderBy('id')
                ->where('is_active', true)
                ->get();
            $urlCount = $urlCount + count($dataRows);
            $siteMapTools->urlRoute = "CategoryView";
            $stringData .= $siteMapTools->Create_XML_Code_new($dataRows);

            foreach (config('app.web_lang') as $key => $lang) {
                $stringData .= $siteMapTools->AddSinglePage($key, 'categories_list');
                $urlCount = $urlCount + 1;
            }

            $dataRows = Blog::orderBy('id')
                ->where('is_active', true)
                ->get();
            $urlCount = $urlCount + count($dataRows);
            $siteMapTools->urlRoute = "blog_view";
            $stringData .= $siteMapTools->Create_XML_Code_new($dataRows);

            SiteMapTools::updateIndexSiteOneFile($catId, $urlCount);

            if (!$this->config['singlePage']) {
                $stringData .= "</urlset>\n";
                fwrite($fh, $stringData);
                fclose($fh);
            } else {
                return $stringData;
            }
        }
    }


}
















