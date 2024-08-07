<?php
namespace App\AppPlugin\BlogPost\Seeder;

use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPostWebSeeder extends Seeder {

    public function run(): void {
        $Config = BlogConfigTraits::DbConfig();

        set_time_limit(0);
        ini_set('memory_limit', '20000M');


        BlogTranslation::unguard();
        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_DataStructure.sql');
        DB::unprepared(file_get_contents($tablePath));


        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_1.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_2.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_3.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_4.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_5.sql');
        DB::unprepared(file_get_contents($tablePath));

        Setting::unguard();
        $tablePath = public_path('db/config_settings.sql');
        DB::unprepared(file_get_contents($tablePath));

        SettingTranslation::unguard();
        $tablePath = public_path('db/config_setting_translations.sql');
        DB::unprepared(file_get_contents($tablePath));


//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_6.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_7.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_8.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_9.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_10.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_11.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_12.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_13.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_14.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_15.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_16.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_17.sql');
//        DB::unprepared(file_get_contents($tablePath));


    }
}
