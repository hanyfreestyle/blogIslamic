<?php
namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogTranslation;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPostWeb3Seeder extends Seeder {

    public function run(): void {

        BlogTranslation::unguard();
        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_11.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_12.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_13.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_14.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_15.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_16.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_17.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
