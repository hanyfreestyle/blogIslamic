<?php

namespace App\Helpers\Seo;

use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Carbon\Carbon;


class SchemaTools {

    public $StopeCash;
    public $setBr;
    public $lang;
    public $langalternate;


    public function __construct(
        $setBr = true,
        $StopeCash = 0,


    ) {
        $this->StopeCash = $StopeCash;
        $this->setBr = $setBr;
        $this->lang = thisCurrentLocale();
        $this->WebConfig = WebMainController::getWebConfig($this->StopeCash);
        $this->DefPhotoList = WebMainController::getDefPhotoList($this->StopeCash);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Businesses() {

        $publisher_logo = getDefPhotoPath($this->DefPhotoList, 'logo', 'photo');

        $line = "";
        $line .= '<script type="application/ld+json">{' . self::PHP_MY_EOL();
        $line .= '"@context": "https://schema.org",' . self::PHP_MY_EOL();
        $line .= '"@type": "' . $this->WebConfig->schema_type . '",' . self::PHP_MY_EOL();
        $line .= '"@id": "' . $this->WebConfig->def_url . '",' . self::PHP_MY_EOL();

        if (count(config('app.web_lang'))) {
            $line .= '"name" : "' . $this->WebConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
            $line .= '"alternateName": "' . $this->WebConfig->translate($this->langalternate)->name . '",' . self::PHP_MY_EOL();
        } else {
            $line .= '"name" : "' . $this->WebConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        }

        $line .= '"logo": "' . $publisher_logo . '",' . self::PHP_MY_EOL();
        $line .= '"image": "' . $publisher_logo . '",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $this->WebConfig->def_url . '",' . self::PHP_MY_EOL();
        $line .= '"telephone": "' . $this->WebConfig->phone_call . '",' . self::PHP_MY_EOL();
        $line .= '"address": {' . self::PHP_MY_EOL();
        $line .= '"@type": "PostalAddress",' . self::PHP_MY_EOL();
        $line .= '"streetAddress": "' . $this->WebConfig->translate($this->lang)->schema_address . '",' . self::PHP_MY_EOL();
        $line .= '"addressLocality": "' . $this->WebConfig->translate($this->lang)->schema_city . '",' . self::PHP_MY_EOL();
        $line .= '"postalCode": "' . $this->WebConfig->schema_postal_code . '",' . self::PHP_MY_EOL();
        $line .= '"addressCountry": "' . $this->WebConfig->schema_country . '"' . self::PHP_MY_EOL();
//        $line .= '"addressRegion": "' . __('web/schema.b_address_region') . '"' . self::PHP_MY_EOL();
        $line .= '},' . self::PHP_MY_EOL();

        if ($this->WebConfig->schema_lat and $this->WebConfig->schema_long) {
            $line .= '"geo": {"@type": "GeoCoordinates","latitude": "' . $this->WebConfig->schema_lat . '","longitude": "' . $this->WebConfig->schema_long . '"},' . self::PHP_MY_EOL();
        }

        $line .= '"openingHoursSpecification": [' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Monday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Tuesday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Wednesday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Thursday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Friday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Saturday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Sunday","opens": "10:00","closes": "18:00"}' . self::PHP_MY_EOL();
        $line .= '],' . self::PHP_MY_EOL();
        $line .= '"priceRange": "1000000",' . self::PHP_MY_EOL();
        $line .= '"sameAs": [' . self::PHP_MY_EOL();

        if ($this->WebConfig->facebook) {
            $line .= '"' . $this->WebConfig->facebook . '",' . self::PHP_MY_EOL();
        }
        if ($this->WebConfig->youtube) {
            $line .= '"' . $this->WebConfig->youtube . '",' . self::PHP_MY_EOL();
        }
        if ($this->WebConfig->twitter) {
            $line .= '"' . $this->WebConfig->twitter . '",' . self::PHP_MY_EOL();
        }
        if ($this->WebConfig->instagram) {
            $line .= '"' . $this->WebConfig->instagram . '",' . self::PHP_MY_EOL();
        }
        $line .= '"' . $this->WebConfig->def_url . '"' . self::PHP_MY_EOL();
        $line .= ']' . self::PHP_MY_EOL();
        $line .= '}</script>' . self::PHP_MY_EOL();

        return $line;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Article($row, $route) {

        $url = urldecode(route($route, $row->slug));
        $Photo = getPhotoPath($row->photo, 'blog', "photo");
        $publisher_logo = getDefPhotoPath($this->DefPhotoList, 'logo', 'photo');

        $line = self::PHP_MY_EOL();
        $line .= '<script type="application/ld+json">' . self::PHP_MY_EOL();
        $line .= '{' . self::PHP_MY_EOL();
        $line .= '"@context": "https://schema.org",' . self::PHP_MY_EOL();
        $line .= '"@type": "NewsArticle",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $url . '",' . self::PHP_MY_EOL();

        $line .= '"author": {' . self::PHP_MY_EOL();
        $line .= '"@type": "Website",' . self::PHP_MY_EOL();
        $line .= '"name": "' . $this->WebConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $Photo . '"' . self::PHP_MY_EOL();
        $line .= '},' . self::PHP_MY_EOL();

        $line .= '"publisher":{' . self::PHP_MY_EOL();
        $line .= '"@type":"Organization",' . self::PHP_MY_EOL();
        $line .= '"name":"' . $this->WebConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        $line .= '"logo":"' . $publisher_logo . '"' . self::PHP_MY_EOL();
        $line .= ' },' . self::PHP_MY_EOL();

        if ($row->translate($this->lang)->g_des) {
            $articleBody = self::Clean($row->translate($this->lang)->g_des);
        } else {
            $articleBody = self::Clean(PrintShortDes($row));
        }

        $line .= '"headline": "' . self::Clean($row->translate($this->lang)->name) . '",' . self::PHP_MY_EOL();
        $line .= '"mainEntityOfPage": "' . $url . '",' . self::PHP_MY_EOL();
        $line .= '"articleBody": "' . $articleBody . '",' . self::PHP_MY_EOL();
        $line .= '"image": "' . $Photo . '",' . self::PHP_MY_EOL();
        $line .= '"datePublished": "' . date(DATE_ATOM, strtotime($row->published_at)) . '",' . self::PHP_MY_EOL();
        $line .= '"dateModified": "' . date(DATE_ATOM, strtotime($row->updated_at)) . '"' . self::PHP_MY_EOL();

        $line .= '}' . self::PHP_MY_EOL();
        $line .= '</script>' . self::PHP_MY_EOL();

        return $line;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PHP_MY_EOL() {
        if ($this->setBr) {
            return PHP_EOL;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Clean($Text) {
        $Text = self::strip_tags_content($Text);
        $Text = preg_replace("/\r|\n/", " ", $Text);
        return $Text;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function strip_tags_content($text, $tags = '', $invert = FALSE) {
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);
        if (is_array($tags) and count($tags) > 0) {
            if ($invert == FALSE) {
                return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
            } else {
                return preg_replace('@<(' . implode('|', $tags) . ')\b.*?>.*?</\1>@si', '', $text);
            }
        } elseif ($invert == FALSE) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        return $text;
    }

}
