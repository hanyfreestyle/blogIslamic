<?php
namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogTranslation;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPostWeb2Seeder extends Seeder {

    public function run(): void {


        set_time_limit(0);
        ini_set('memory_limit', -1);


        BlogTranslation::unguard();
        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_6.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_7.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_8.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_9.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_10.sql');
        DB::unprepared(file_get_contents($tablePath));




    }
}
