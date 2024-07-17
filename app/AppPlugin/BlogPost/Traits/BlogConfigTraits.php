<?php

namespace App\AppPlugin\BlogPost\Traits;


use App\Http\Traits\DefModelConfigTraits;

trait BlogConfigTraits {

    public function LoadConfig() {
        $defConfig = DefModelConfigTraits::defConfig();

        $Config = [
            'DbCategory'=>'blog_categories',
            'DbCategoryTrans'=>'blog_category_translations',
            'DbPost'=>'blog_post',
            'DbPostTrans'=>'blog_translations',
            'DbPostCatId'=>'blog_id',
            'DbPhoto'=>'blog_photos',
            'DbPhotoTrans'=>'blog_photo_translations',
            'DbTags'=>'blog_tags',
            'DbTagsTrans'=>'blog_tags_translations',

            'categoryTree' => true,
            'categoryDeep' => 2,
            'categoryPhotoAdd' => true,
            'categoryPhotoView' => true,
            'categoryIcon' => false,
            'categoryDelete' => false,
            'categorySort' => false,
            'categoryEditor' => true,
            'categoryDes' => true,
            'categorySeo' => true,
            'categorySlug' => true,
            'categoryShowLang' => true,
            'categoryFullRow' => false,

            'postPublishedDate' => true,
            'postPhotoAdd' => true,
            'postPhotoView' => true,
            'postFullRow' => false,
            'postShowLang' => true,
            'postEditor' => true,
            'postDes' => true,
            'postSeo' => true,
            'postSlug' => true,
            'postYoutube' => false,
            'postWebSlug' => null,

            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),
            'LangPostPublishedDateName' => __('admin/form.text_published_at'),
            'LangPostDefName' => __('admin/blogPost.blog_text_name'),
            'LangPostDefDes' => __('admin/form.text_content'),


            'postAddBrand' => true,
        ];
        $Config = array_merge($defConfig, $Config);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

    static function DbConfig() {

        $Config = new class {
            use BlogConfigTraits;
        };

        return $Config->LoadConfig();
    }

}
