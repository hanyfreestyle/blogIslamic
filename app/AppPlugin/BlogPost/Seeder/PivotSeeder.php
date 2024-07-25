<?php
namespace App\AppPlugin\BlogPost\Seeder;

use App\AppPlugin\BlogPost\Models\BlogPivot;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\AppPlugin\BlogPost\Models\BlogTagsPivot;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PivotSeeder extends Seeder {

    public function run(): void {

        $Config = BlogConfigTraits::DbConfig();

        if($Config['TableCategory']){
            BlogPivot::unguard();
            $tablePath = public_path('db/blogcategory_blog.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if($Config['TableTags']){
            BlogTagsPivot::unguard();
            $tablePath = public_path('db/blog_tags_post.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        BlogReview::unguard();
        $tablePath = public_path('db/blog_post_review.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
