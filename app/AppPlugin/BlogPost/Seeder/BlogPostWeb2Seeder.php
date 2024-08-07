<?php
namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPostWeb2Seeder extends Seeder {

    public function run(): void {


        set_time_limit(0);
        ini_set('memory_limit', '20000M');


        BlogTranslation::unguard();
        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_6.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_7.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_8.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_9.sql');
        DB::unprepared(file_get_contents($tablePath));

//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_10.sql');
//        DB::unprepared(file_get_contents($tablePath));

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
