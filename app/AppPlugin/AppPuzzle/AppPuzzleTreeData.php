<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeData {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ModelTree
    static function DataTree() {
        $modelTree = [

            'ConfigData' => self::treeConfigData(),
            'DataCountry' => self::treeDataCountry(),
            'DataCity' => self::treeDataCity(),
            'DataArea' => self::treeDataArea(),
            'LeadCategory' => self::treeLeadCategory(),
            'LeadSours' => self::treeLeadSours(),
            'BrandName' => self::treeBrandName(),
            'DeviceType' => self::treeDeviceType(),
            'Evaluation' => self::treeEvaluation(),
            'DataBookRelease' => self::DataBookRelease(),
            'DataBookLang' => self::DataBookLang(),
        ];

        return $modelTree;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeConfigData() {
        return [
            'view' => true,
            'id' => "ConfigData",
            'CopyFolder' => "ConfigData",
            'appFolder' => 'Data/ConfigData',
            'viewFolder' => 'ConfigData',
            'routeFolder' => "data/",
            'routeFile' => 'configData.php',
            'migrations' => ['2019_12_14_000017_create_data_table.php'],
            'seeder' => ['config_data.sql', 'config_data_translations.sql'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeDataCountry() {
        return [
            'view' => true,
            'id' => "DataCountry",
            'CopyFolder' => "DataCountry",
            'appFolder' => 'Data/Country',
            'viewFolder' => 'DataCountry',
            'routeFolder' => "data/",
            'routeFile' => 'country.php',
            'migrations' => ['2019_12_14_000014_create_countries_table.php'],
            'seeder' => ['data_countries.sql', 'data_country_translations.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dataCountry.php'],
            'assetsFolder' => ['flag'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeDataCity() {
        return [
            'view' => true,
            'id' => "DataCity",
            'CopyFolder' => "DataCity",
            'appFolder' => 'Data/City',
            'viewFolder' => 'DataCity',
            'routeFolder' => "data/",
            'routeFile' => 'city.php',
            'migrations' => ['2019_12_14_000015_create_cities_table.php'],
            'seeder' => ['data_city.sql', 'data_city_translations.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dataCity.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeDataArea() {
        return [
            'view' => true,
            'id' => "DataArea",
            'CopyFolder' => "DataArea",
            'appFolder' => 'Data/Area',
            'viewFolder' => 'DataArea',
            'routeFolder' => "data/",
            'routeFile' => 'area.php',
            'migrations' => ['2019_12_14_000016_create_area_table.php'],
            'seeder' => ['data_area.sql', 'data_area_translations.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dataArea.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeLeadCategory() {
        return [
            'view' => true,
            'id' => "LeadCategory",
            'CopyFolder' => "DataLeadCategory",
            'appFolder' => 'Data/DataLeadCategory',
            'routeFolder' => "data/",
            'routeFile' => 'data_LeadCategory.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['LeadCategory.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeLeadSours() {
        return [
            'view' => true,
            'id' => "LeadSours",
            'CopyFolder' => "DataLeadSours",
            'appFolder' => 'Data/DataLeadSours',
            'routeFolder' => "data/",
            'routeFile' => 'data_LeadSours.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['LeadSours.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeBrandName() {
        return [
            'view' => true,
            'id' => "BrandName",
            'CopyFolder' => "DataBrandName",
            'appFolder' => 'Data/DataBrandName',
            'routeFolder' => "data/",
            'routeFile' => 'data_BrandName.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['BrandName.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeDeviceType() {
        return [
            'view' => true,
            'id' => "DeviceType",
            'CopyFolder' => "DataDeviceType",
            'appFolder' => 'Data/DataDeviceType',
            'routeFolder' => "data/",
            'routeFile' => 'data_DeviceType.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['DeviceType.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeEvaluation() {
        return [
            'view' => true,
            'id' => "Evaluation",
            'CopyFolder' => "DataEvaluationCust",
            'appFolder' => 'Data/DataEvaluationCust',
            'routeFolder' => "data/",
            'routeFile' => 'data_EvaluationCust.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['EvaluationCust.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function DataBookRelease() {
        return [
            'view' => true,
            'id' => "DataBookRelease",
            'CopyFolder' => "DataBookRelease",
            'appFolder' => 'Data/DataBookRelease',
            'routeFolder' => "data/",
            'routeFile' => 'data_BookRelease.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['BookRelease.php'],
        ];
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function DataBookLang() {
        return [
            'view' => true,
            'id' => "DataBookLang",
            'CopyFolder' => "DataBookLang",
            'appFolder' => 'Data/DataBookLang',
            'routeFolder' => "data/",
            'routeFile' => 'data_BookLang.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['BookLang.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


}
