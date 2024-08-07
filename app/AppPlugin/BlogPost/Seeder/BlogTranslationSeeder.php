<?php
namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogTranslationSeeder extends Seeder {

    public function run(): void {

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

    }
}
