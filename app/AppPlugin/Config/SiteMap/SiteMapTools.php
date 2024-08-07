<?php

namespace App\AppPlugin\Config\SiteMap;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class SiteMapTools {

    public $urlRoute;
    public $xmlFileName;
    public $dataRows;

    public $addLastUpdate;

    public $addPhoto;
    public $photoFiledName;
    public $photoCaption;
    public $addAlternate;
    public $langAr;
    public $langEn;
    public $blogslug;

    public function __construct(
        $urlRoute = null,
        $xmlFileName = null,
        $dataRows = array(),

        $addLastUpdate = true,
        $addPhoto = true,
        $photoFiledName = 'photo',
        $photoCaption = 'name',
        $addAlternate = false,
        $langAr = false,
        $langEn = false,
        $blogslug = false,
    ) {
        $this->urlRoute = $urlRoute;
        $this->xmlFileName = $xmlFileName;
        $this->dataRows = $dataRows;

        $this->addLastUpdate = $addLastUpdate;

        $this->addPhoto = $addPhoto;
        $this->photoFiledName = $photoFiledName;
        $this->photoCaption = $photoCaption;

        $this->addAlternate = $addAlternate;
        $this->langAr = $langAr;
        $this->langEn = $langEn;
        $this->blogslug = $blogslug;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   XML_Header
    public function XML_Header() {
        $stringData = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="sitemap-style.xsl"?>' . "\n";
        $stringData .= '<urlset xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"  ';
        $stringData .= ' xmlns:image="https://www.google.com/schemas/sitemap-image/1.1" ';
        $stringData .= ' xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 ';
        $stringData .= ' https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd ';
        $stringData .= ' https://www.google.com/schemas/sitemap-image/1.1 ';
        $stringData .= ' https://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" ';
        $stringData .= ' xmlns:xhtml="https://www.w3.org/1999/xhtml"';
        $stringData .= ' xmlns="https://www.sitemaps.org/schemas/sitemap/0.9" ';
        $stringData .= ' >' . "\n";
        return $stringData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   XML_HeaderSinglePage
    public function XML_HeaderSinglePage() {
        $stringData = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $stringData .= '<urlset xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"  ';
        $stringData .= ' xmlns:image="https://www.google.com/schemas/sitemap-image/1.1" ';
        $stringData .= ' xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 ';
        $stringData .= ' https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd ';
        $stringData .= ' https://www.google.com/schemas/sitemap-image/1.1 ';
        $stringData .= ' https://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" ';
        $stringData .= ' xmlns:xhtml="https://www.w3.org/1999/xhtml"';
        $stringData .= ' xmlns="https://www.sitemaps.org/schemas/sitemap/0.9" ';
        $stringData .= ' >' . "\n";
        return $stringData;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AddSinglePage
    public function AddSinglePage($lang, $Route) {
        if ($lang == 'en') {
            $alternateLang = 'ar';
        } elseif ($lang == 'ar') {
            $alternateLang = 'en';
        }
        $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route($Route)));

        $stringData = "\t\t<url>\n";
        $stringData .= "\t\t\t<loc>$Url</loc>\n";

        if ($this->addAlternate == true and count(config('app.web_lang')) > 1) {
            $UrlAlternate = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route($Route)));
            $stringData .= "\t\t\t" . '<xhtml:link rel="alternate" hreflang="' . $alternateLang . '" href="' . $UrlAlternate . '"/>' . "\n";
        }

        $LastUpdate = date(DATE_ATOM, strtotime(now()));
        $stringData .= "\t\t\t<lastmod>$LastUpdate</lastmod>\n";

        $stringData .= "\t\t</url>\n";
        return $stringData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    Create_XML_Code
    public function Create_XML_Code() {

        $stringData = "";
        if ($this->langEn == true) {
            $lang = 'en';
            foreach ($this->dataRows as $row) {
                if (isset($row->translate($lang)->name)) {
                    $stringData .= "\t\t<url>\n";
                    $stringData .= self::addUrlCode($lang, $row);
                    $stringData .= self::AddLastUpdateCode($row);
                    $stringData .= self::AddPhotoCode($row, $lang);
                    $stringData .= "\t\t</url>\n";
                }
            }
        }

        if ($this->langAr == true) {
            $lang = 'ar';
            foreach ($this->dataRows as $row) {
                if (isset($row->translate($lang)->name)) {
                    $stringData .= "\t\t<url>\n";
                    $stringData .= self::addUrlCode($lang, $row);
                    $stringData .= self::AddLastUpdateCode($row);
                    $stringData .= self::AddPhotoCode($row, $lang);
                    $stringData .= "\t\t</url>\n";
                }
            }
        }
        return $stringData;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    Create_XML_Code_new
    public function Create_XML_Code_new($dataRows) {

        $stringData = "";
        if ($this->langEn == true) {
            $lang = 'en';
            foreach ($dataRows as $row) {
                if (isset($row->translate($lang)->name)) {
                    $stringData .= "\t\t<url>\n";
                    $stringData .= self::addUrlCode($lang, $row);
                    $stringData .= self::AddLastUpdateCode($row);
                    $stringData .= self::AddPhotoCode($row, $lang);
                    $stringData .= "\t\t</url>\n";
                }
            }
        }

        if ($this->langAr == true) {
            $lang = 'ar';
            foreach ($dataRows as $row) {
                if (isset($row->translate($lang)->name)) {
                    $stringData .= "\t\t<url>\n";
                    $stringData .= self::addUrlCode($lang, $row);
                    $stringData .= self::AddLastUpdateCode($row);
                    $stringData .= self::AddPhotoCode($row, $lang);
                    $stringData .= "\t\t</url>\n";
                }
            }
        }
        return $stringData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    Create_XML_File
    public function Create_XML_File() {

        $fh = fopen($this->xmlFileName, 'w') or die("can't open file");

        $stringData = self::XML_Header();

        if ($this->langEn == true) {
            $lang = 'en';

            foreach ($this->dataRows as $row) {
                if (isset($row->translate($lang)->name)) {
                    $stringData .= "\t\t<url>\n";
                    $stringData .= self::addUrlCode($lang, $row);
                    $stringData .= self::AddLastUpdateCode($row);
                    $stringData .= self::AddPhotoCode($row, $lang);
                    $stringData .= "\t\t</url>\n";
                }
            }
        }

        if ($this->langAr == true) {
            $lang = 'ar';
            foreach ($this->dataRows as $row) {
                if (isset($row->translate($lang)->name)) {
                    $stringData .= "\t\t<url>\n";
                    $stringData .= self::addUrlCode($lang, $row);
                    $stringData .= self::AddLastUpdateCode($row);
                    $stringData .= self::AddPhotoCode($row, $lang);
                    $stringData .= "\t\t</url>\n";
                }
            }
        }

        $stringData .= "</urlset>\n";
        fwrite($fh, $stringData);

        fclose($fh);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     addAlternateCode
    public function addUrlCode($lang, $row) {

        if ($lang == 'en') {
            $alternateLang = 'ar';
        } elseif ($lang == 'ar') {
            $alternateLang = 'en';
        }

        $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route($this->urlRoute, $row['slug'])));

        $stringData = "\t\t\t<loc>$Url</loc>\n";

        if ($this->addAlternate == true and count(config('app.web_lang')) > 1) {
            if (isset($row->translate($alternateLang)->name)) {
                if ($this->blogslug == true) {
                    $UrlAlternate = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route($this->urlRoute, [$row->getCatName->slug, $row->slug])));
                } else {
                    $UrlAlternate = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route($this->urlRoute, $row['slug'])));
                }
                $stringData .= "\t\t\t" . '<xhtml:link rel="alternate" hreflang="' . $alternateLang . '" href="' . $UrlAlternate . '"/>' . "\n";
            }
        }


        return $stringData;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  AddLastUpdateCode
    public function AddLastUpdateCode($row) {
        if ($this->addLastUpdate == true) {
            $LastUpdate = date(DATE_ATOM, strtotime($row['updated_at']));
            $stringData = "\t\t\t<lastmod>$LastUpdate</lastmod>\n";
            return $stringData;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AddPhotoCode($row, $lang) {

        if ($this->addPhoto == '1' and $row[$this->photoFiledName] != null) {
            $DefPhoto = url($row[$this->photoFiledName]);
            $DefPhotoName = $row->translate($lang)->name;
            $stringData = "\t\t\t<image:image>\n";
            $stringData .= "\t\t\t\t<image:loc>$DefPhoto</image:loc>\n";
            $stringData .= "\t\t\t\t<image:caption><![CDATA[$DefPhotoName]]></image:caption>\n";
            $stringData .= "\t\t\t</image:image>\n";
            return $stringData;
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     updateIndexSiteMapTable
    static function updateIndexSiteMapTable($cat_id, $siteMap_PerFile, $countTable) {

        $xmlFileWasAdd = SiteMap::where('cat_id', $cat_id)->get()->toArray();

        if (count($xmlFileWasAdd) > '0') {
            for ($i = 0; $i < count($xmlFileWasAdd); $i++) {
                $thisFileName = public_path($xmlFileWasAdd[$i]['name']);
                @unlink($thisFileName);
            }
            SiteMap::where('cat_id', $cat_id)->delete();
        }

        if ($countTable > 0) {
            $CountFile = $countTable / $siteMap_PerFile;
            $CountFile = intval(ceil($CountFile));
            for ($i = 1; $i <= $CountFile; $i++) {
                $savedata = new SiteMap;
                $savedata->name = "sitemap." . $cat_id . "_" . $i . ".xml";
                $savedata->cat_id = $cat_id;
                $savedata->save();
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     updateIndexSiteMapTable
    static function updateIndexSiteOneFile($cat_id, $urlCount) {
//        $xmlFileWasAdd = SiteMap::where('cat_id', $cat_id)->get()->toArray();
//
//        if (count($xmlFileWasAdd) > '0') {
//            for ($i = 0; $i < count($xmlFileWasAdd); $i++) {
//                $thisFileName = public_path($xmlFileWasAdd[$i]['name']);
//                @unlink($thisFileName);
//            }
//            SiteMap::where('cat_id', $cat_id)->delete();
//        }

        $savedata = new SiteMap;
        $savedata->name = "sitemap." . $cat_id . ".xml";
        $savedata->cat_id = $cat_id;
        $savedata->url_count = $urlCount;
        $savedata->save();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # updateIndexSiteMapXmlFile

    static function updateIndexSiteMapXmlFile($singlePage) {

        if (!$singlePage) {
            $myFile = public_path("sitemap_index.xml");
            $fh = fopen($myFile, 'w') or die("can't open file");
            $stringData = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="sitemap-style.xsl"?>' . "\n";
            $stringData .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            fwrite($fh, $stringData);

            $siteMapList = SiteMap::orderBy('name')->get()->toArray();
            if (count($siteMapList) > '0') {
                $This_stringData = "";
                for ($i = 0; $i < count($siteMapList); $i++) {
                    $ThisUrl = urldecode(url($siteMapList[$i]['name']));
                    $LastUpdate = date(DATE_ATOM, strtotime($siteMapList[$i]['updated_at']));
                    $This_stringData .= "\t\t<sitemap>\n";
                    $This_stringData .= "\t\t\t<loc>$ThisUrl</loc>\n";
                    $This_stringData .= "\t\t\t<lastmod>$LastUpdate</lastmod>\n";
                    $This_stringData .= "\t\t</sitemap>\n";
                }
                fwrite($fh, $This_stringData);
            }
            $stringData = "</sitemapindex>\n";
            fwrite($fh, $stringData);
            fclose($fh);

            SiteMapTools::updateRobotsTxt($siteMapList);
        } else {
            SiteMapTools::updateRobotsTxtsinglePage();
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    updateRobotsTxt
    static function updateRobotsTxt($siteMapList) {

        $myFile = public_path('robots.txt');
        $fh = fopen($myFile, 'w') or die("can't open file");

        $lines = "";
        $lines .= "User-agent: *" . "\n";
        $lines .= "Allow: /" . "\n";

        $lines .= "Disallow:" . "\n";
        $lines .= "Disallow: /cgi-bin/" . "\n";
        $lines .= "Disallow: /app/" . "\n";
        $lines .= "Disallow: /bootstrap/" . "\n";
        $lines .= "Disallow: /config/" . "\n";
        $lines .= "Disallow: /database/" . "\n";
        $lines .= "Disallow: /resources/" . "\n";
        $lines .= "Disallow: /routes/" . "\n";
        $lines .= "Disallow: /database/" . "\n";
        $lines .= "Disallow: /temp/" . "\n";
        $lines .= "Disallow: /tests/" . "\n";
        $lines .= "Disallow: /vendor/" . "\n";

        fwrite($fh, $lines);
        if (count($siteMapList) > '0') {
            $This_stringData = "\n";
            for ($i = 0; $i < count($siteMapList); $i++) {
                $ThisUrl = urldecode(url($siteMapList[$i]['name']));
                $This_stringData .= "Sitemap: " . $ThisUrl . "\n";;
            }
            fwrite($fh, $This_stringData);
        }
        fclose($fh);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    updateRobotsTxtsinglePage
    static function updateRobotsTxtsinglePage() {

        $myFile = public_path('robots.txt');
        $fh = fopen($myFile, 'w') or die("can't open file");

        $lines = "";
        $lines .= "User-agent: *" . "\n";
        $lines .= "Allow: /" . "\n";

        $lines .= "Disallow:" . "\n";
        $lines .= "Disallow: /cgi-bin/" . "\n";
        $lines .= "Disallow: /app/" . "\n";
        $lines .= "Disallow: /bootstrap/" . "\n";
        $lines .= "Disallow: /config/" . "\n";
        $lines .= "Disallow: /database/" . "\n";
        $lines .= "Disallow: /resources/" . "\n";
        $lines .= "Disallow: /routes/" . "\n";
        $lines .= "Disallow: /database/" . "\n";
        $lines .= "Disallow: /temp/" . "\n";
        $lines .= "Disallow: /tests/" . "\n";
        $lines .= "Disallow: /vendor/" . "\n";

        fwrite($fh, $lines);
        $This_stringData = "\n";
        $ThisUrl = urldecode(url('sitemap.xml'));
        $This_stringData .= "Sitemap: " . $ThisUrl . "\n";;
        fwrite($fh, $This_stringData);
        fclose($fh);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ForSaleCode
    static function ForSaleCode($dataRows, $lang, $alternateLang) {
        $LastUpdate = date(DATE_ATOM, strtotime(now()));
        $stringData = "";
        foreach ($dataRows as $row) {
            if (isset($row->translate($lang)->name)) {
                $stringData .= "\t\t<url>\n";
                $Url = urldecode(PageAdminController::createPagesLink($lang, $row));
                $Url = str_replace('&', '&amp;', $Url);

                $stringData .= "\t\t\t<loc>$Url</loc>\n";

                if (isset($row->translate($alternateLang)->name)) {
                    $UrlAlternate = urldecode(PageAdminController::createPagesLink($alternateLang, $row));
                    $UrlAlternate = str_replace('&', '&amp;', $UrlAlternate);
                    $stringData .= "\t\t\t" . '<xhtml:link rel="alternate" hreflang="' . $alternateLang . '" href="' . $UrlAlternate . '"/>' . "\n";
                }
                $stringData .= "\t\t\t<lastmod>$LastUpdate</lastmod>\n";
                $stringData .= "\t\t</url>\n";
            }
        }
        return $stringData;

    }



//        $addMorePhoto = AdminHelper::arrIsset($SendData,"addMorePhoto","0");
//        $morePhotoFieldName = AdminHelper::arrIsset($SendData,"morePhotoFieldName","");


    //        if($addMorePhoto == '1'){
//            $photos = explode(',', $tableData[$morePhotoFieldName]);
//            if(count($photos) > 0 ){
//                for($i = 0; $i < count($photos); $i++) {
//                    $ThisUrl = uploaded_asset($photos[$i]);
//                    $ThisName = $tableData[$photoName];
//                    $code .= "\t\t\t<image:image>\n";
//                    $code .= "\t\t\t\t<image:loc>$ThisUrl</image:loc>\n";
//                    $code .= "\t\t\t\t<image:caption><![CDATA[$ThisName]]></image:caption>\n";
//                    $code .= "\t\t\t</image:image>\n";
//                }
//            }
//        }

}
