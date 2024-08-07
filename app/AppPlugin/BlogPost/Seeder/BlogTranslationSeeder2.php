<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogTranslation;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogTranslationSeeder2 extends Seeder {

    public function run(): void {


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
