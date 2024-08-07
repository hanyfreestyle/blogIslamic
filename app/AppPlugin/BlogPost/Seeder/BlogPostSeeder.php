<?php
namespace App\AppPlugin\BlogPost\Seeder;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPostSeeder extends Seeder {
    public function run(): void {

        set_time_limit(0);
        ini_set('memory_limit', '20000M');

        Blog::unguard();
        $tablePath = public_path('db/blog_post.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
