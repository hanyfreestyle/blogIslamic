<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeModel {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ModelTree
    static function ModelTree() {

        $modelTree = [
            'ModelMainPost' => self::treeModelMainPost(),
            'BlogPost' => self::treeModelBlogPost(),
            'FileManager' => self::treeFileManager(),
            'BlogPostTable' => self::treeBlogPostTable(),
            'Faq' => self::treeFaq(),
            'Pages' => self::treePages(),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeModelMainPost() {
        return [
            'view' => true,
            'id' => "ModelMainPost",
            'CopyFolder' => "ModelsMainPost",
            'appFolder' => 'Models/MainPost',
            'viewFolder' => 'ModelMainPost',
            'routeFolder' => "model/",
            'routeFile' => 'mainPost.php',
            'migrations' => [
                '2019_12_14_000018_create_post_categories_table.php',
                '2019_12_14_000019_create_post_table.php',
                '2019_12_14_000020_create_post_tags_table.php',
                '2019_12_14_000021_create_post_photos_table.php',
            ],
            'seeder' => [
                'app_category.sql', 'app_category_post.sql', 'app_category_translations.sql',
                'app_photo.sql', 'app_photo_translations.sql',
                'app_post.sql', 'app_post_review.sql', 'app_post_translations.sql',
                'app_tags.sql', 'app_tags_post.sql', 'app_tags_translations.sql',
            ],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeModelBlogPost() {
        return [
            'view' => true,
            'id' => "BlogPost",
            'CopyFolder' => "ModelsBlogPost",
            'appFolder' => 'Models/BlogPost',
            'routeFolder' => "model/",
            'routeFile' => 'BlogPost.php',
            'adminLangFolder' => "admin/model/",
            'adminLangFiles' => ['blogPost.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeBlogPostTable() {
        return [
            'view' => true,
            'id' => "BlogPostTable",
            'CopyFolder' => "BlogPost",
            'appFolder' => 'BlogPost',
            'viewFolder' => 'BlogPost',
            'routeFolder' => null,
            'routeFile' => 'blogPost.php',
            'migrations' => [
                '2021_01_02_000001_create_blog_model_table.php',
            ],

            'seeder' => [
                'blog_categories.sql',
                'blog_category_translations.sql',
                'blog_photo_translations.sql',
                'blog_photos.sql',
                'blog_post.sql',
                'blog_tags.sql',
                'blog_tags_post.sql',
                'blog_tags_translations.sql',
                'blog_translations.sql',
                'blogcategory_blog.sql',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['blogPost.php'],
            'photoFolder' => ['blog-category', 'blog'],
        ];

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeFileManager() {
        return [
            'view' => true,
            'id' => "FileManager",
            'CopyFolder' => "FileManager",
            'appFolder' => 'FileManager',
            'viewFolder' => 'FileManager',
            'routeFolder' => null,
            'routeFile' => 'fileManager.php',
            'migrations' => ['2019_12_14_000008_create_file_manager_table.php'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['fileManager.php'],
            'assetsFolder' => ['admin-plugins/file-manager'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeFaq() {
        return [
            'view' => true,
            'id' => "Faq",
            'CopyFolder' => "Faq",
            'appFolder' => 'Faq',
            'viewFolder' => 'Faq',
            'routeFolder' => null,
            'routeFile' => 'faq.php',
            'migrations' => [
                '2021_01_01_000001_create_faq_model_table.php',
            ],

            'seeder' => [
                'faq_category.sql',
                'faq_category_faq.sql',
                'faq_category_translations.sql',
                'faq_faqs.sql',
                'faq_faqs_review.sql',
                'faq_photo.sql',
                'faq_photo_translations.sql',
                'faq_tags.sql',
                'faq_tags_post.sql',
                'faq_tags_translations.sql',
                'faq_translations.sql',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['faq.php'],
            'photoFolder' => ['faq', 'faqcategory'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treePages() {
        return [
            'view' => true,
            'id' => "Pages",
            'CopyFolder' => "Pages",
            'appFolder' => 'Pages',
            'viewFolder' => 'Pages',
            'routeFolder' => null,
            'routeFile' => 'pages.php',
            'migrations' => [
                '2020_01_01_000001_create_page_model_table.php',
            ],

            'seeder' => [
                'page_categories.sql',
                'page_category_translations.sql',
                'page_pages.sql',
                'page_photo_translations.sql',
                'page_photos.sql',
                'page_translations.sql',
                'pagecategory_page.sql',
                'page_tags.sql',
                'page_tags_post.sql',
                'page_tags_translations.sql',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['pages.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


}
