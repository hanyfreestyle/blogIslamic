<?php

namespace App\Http\Traits;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


trait DefModelConfigTraits {

    static function defConfig() {
        $Config = [
            'DbCategoryForeign'=>'category_id',

            'TableCategory' => true,
            'TableTags' => true,
            'TableTagsOnFly' => true,
            'TableReview' => true,

            'TableMorePhotos' => true,
            'MorePhotosEdit' => false,

            'categoryTree' => true,
            'categoryDeep' => 2,
            'categoryPhotoAdd' => false,
            'categoryPhotoView' => false,
            'categoryIcon' => true,
            'categoryDelete' => true,
            'categorySort' => true,
            'categoryEditor' => true,
            'categoryDes' => true,
            'categorySeo' => true,
            'categorySlug' => true,
            'categoryShowLang' => true,
            'categoryFullRow' => false,
            'categoryDefLang' => self::defLangStatic(),

            'postPublishedDate' => false,
            'postPhotoAdd' => false,
            'postPhotoView' => true,
            'postFullRow' => false,
            'postShowLang' => true,
            'postEditor' => false,
            'postDes' => false,
            'postSeo' => false,
            'postSlug' => true,
            'postYoutube' => false,
            'postWebSlug' => null,

            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),
            'LangPostPublishedDateName' => __('admin/form.text_published_at'),
            'LangPostDefName' => __('admin/form.text_title'),
            'LangPostDefDes' => __('admin/form.text_content'),

            'postAddBrand' => false,
        ];

        return $Config;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function defLangStatic() {
        if (count(config('app.web_lang')) > 1) {
            $lang = LaravelLocalization::getCurrentLocale();
        } else {
            $lang = config('app.def_dataTableLang');
        }
        return $lang;
    }
}
