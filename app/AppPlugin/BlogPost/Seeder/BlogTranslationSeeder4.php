<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogPivot;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\AppPlugin\BlogPost\Models\BlogTagsPivot;
use App\AppPlugin\BlogPost\Models\BlogTranslation;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogTranslationSeeder4 extends Seeder {

    public function run(): void {

        BlogTranslation::unguard();
        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_16.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/blog_translations_17.sql');
        DB::unprepared(file_get_contents($tablePath));

        BlogPivot::unguard();
        $tablePath = public_path('db/blogcategory_blog.sql');
        DB::unprepared(file_get_contents($tablePath));

        BlogTagsPivot::unguard();
        $tablePath = public_path('db/blog_tags_post.sql');
        DB::unprepared(file_get_contents($tablePath));


        BlogReview::unguard();
        $tablePath = public_path('db/blog_post_review.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
