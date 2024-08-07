<?php
namespace App\AppPlugin\BlogPost\Seeder;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPostSubSeeder extends Seeder {

    public function run(): void {

        set_time_limit(0);
        ini_set('memory_limit', '20000M');


        BlogTranslation::unguard();
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_3.sql');
//        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_4.sql');
        DB::unprepared(file_get_contents($tablePath));

//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_5.sql');
//        DB::unprepared(file_get_contents($tablePath));

//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_6.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_7.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_8.sql');
//        DB::unprepared(file_get_contents($tablePath));


    }
}
