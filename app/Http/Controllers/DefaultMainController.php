<?php

namespace App\Http\Controllers;

use App\AppCore\DefPhoto\DefPhoto;
use App\AppCore\WebSettings\Models\Setting;
use App\AppPlugin\Config\Meta\MetaTag;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\Country\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class DefaultMainController extends Controller {

    public $priceRang_Arr;
    public $Property_TypeArr;

    public function __construct() {

        $Continent_Arr = [
            "1" => ['id' => 'AS', 'name' => __('admin/dataCountry.continent_as')],
            "2" => ['id' => 'EU', 'name' => __('admin/dataCountry.continent_eu')],
            "3" => ['id' => 'AF', 'name' => __('admin/dataCountry.continent_af')],
            "4" => ['id' => 'OC', 'name' => __('admin/dataCountry.continent_oc')],
            "5" => ['id' => 'NA', 'name' => __('admin/dataCountry.continent_na')],
            "6" => ['id' => 'AN', 'name' => __('admin/dataCountry.continent_an')],
            "7" => ['id' => 'SA', 'name' => __('admin/dataCountry.continent_sa')],
        ];
        View::share('Continent_Arr', $Continent_Arr);
        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $this->cashCityList = self::CashCityList();
            View::share('cashCityList', $this->cashCityList);
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCountryList
    static function CashCountryList($stopCash = 0) {
        if ($stopCash) {
            $CashCountryList = Country::select('id', 'iso2')->with('translation')->orderByTranslation('name', 'ASC')->get();
        } else {
            $CashCountryList = Cache::remember('CashCountryList', cashDay(7), function () {
                return Country::select('id', 'iso2')->with('translation')->orderByTranslation('name', 'ASC')->get();
            });
        }
        return $CashCountryList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCityList
    static function CashCityList($stopCash = 0) {
        if ($stopCash) {
            $CashCityList = City::with('translation')->orderby('postion')->get();
        } else {
            $CashCityList = Cache::remember('CashCityList', cashDay(7), function () {
                return City::with('translation')->orderby('postion')->get();
            });
        }
        return $CashCityList;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getWebConfig
    static function getWebConfig($stopCash = 0) {
        if ($stopCash) {
            $WebConfig = Setting::where('id', 1)->with('translations')->first();
        } else {
            $WebConfig = Cache::remember('WebConfig_Cash', cashDay(1), function () {
                return Setting::where('id', 1)->with('translations')->first();
            });
        }
        return $WebConfig;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefPhotoList
    static function getDefPhotoList($stopCash = 0) {
        if ($stopCash) {
            $DefPhotoList = DefPhoto::get()->keyBy('cat_id');
        } else {
            $DefPhotoList = Cache::remember('DefPhotoList_Cash', cashDay(7), function () {
                return DefPhoto::get()->keyBy('cat_id');
            });
        }
        return $DefPhotoList;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefPhotoById
    static function getDefPhotoById($cat_id) {
        $DefPhoto = self::getDefPhotoList(0);
        if ($DefPhoto->has($cat_id)) {
            return $DefPhoto[$cat_id];
        } else {
            return $DefPhoto['dark_logo'] ?? '';
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function getMeatByCatId($cat_id) {
        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $WebMeta = Cache::remember('WebMeta_Cash', cashDay(7), function () {
                return MetaTag::with('translation')->get()->keyBy('cat_id');
            });
            if ($WebMeta->has($cat_id)) {
                return $WebMeta[$cat_id];
            } else {
                return $WebMeta['home'] ?? '';
            }
        } else {
            return [];
        }
    }


}
