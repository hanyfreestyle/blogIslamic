<?php

namespace Database\Seeders;


use App\AppCore\AdminRole\Seeder\PermissionSeeder;
use App\AppCore\AdminRole\Seeder\AdminUserSeeder;
use App\AppCore\AdminRole\Seeder\RoleSeeder;
use App\AppCore\AdminRole\Seeder\UsersTableSeeder;
use App\AppCore\WebSettings\Seeder\SettingsTableSeeder;
use App\AppCore\DefPhoto\DefPhotoSeeder;
use App\AppCore\UploadFilter\Seeder\UploadFilterSeeder;
use App\AppCore\Menu\AdminMenuSeeder;


use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogCategoryTranslation;
use App\AppPlugin\BlogPost\Models\BlogPivot;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Seeder\BlogPostSeeder;
use App\AppPlugin\BlogPost\Seeder\PivotSeeder;
use App\AppPlugin\Config\Meta\SeederMetaTag;
use App\AppPlugin\Config\Privacy\SeederWebPrivacy;
use App\AppPlugin\BlogPost\Seeder\BlogCategorySeeder;


use App\AppPlugin\Pages\Seeder\PageSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder {

    public function run(): void {

        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(SettingsTableSeeder::class);
        $this->call(DefPhotoSeeder::class);
        $this->call(UploadFilterSeeder::class);
        $this->call(AdminMenuSeeder::class);

        if (File::isFile(base_path('routes/AppPlugin/crm/ImportData.php'))) {
            $this->call(ImportDataSeeder::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $this->call(SeederMetaTag::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $this->call(SeederWebPrivacy::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {
            $testReview = 0 ;
            if($testReview){
                BlogCategory::unguard();
                $tablePath = public_path('db/blog_categories.sql');
                DB::unprepared(file_get_contents($tablePath));

                BlogCategoryTranslation::unguard();
                $tablePath = public_path('db/blog_category_translations.sql');
                DB::unprepared(file_get_contents($tablePath));

                Blog::unguard();
                $tablePath = public_path('db/_test/blog_post.sql');
                DB::unprepared(file_get_contents($tablePath));

                BlogTranslation::unguard();
                $tablePath = public_path('db/_test/blog_translations.sql');
                DB::unprepared(file_get_contents($tablePath));

                BlogPivot::unguard();
                $tablePath = public_path('db/_test/blogcategory_blog.sql');
                DB::unprepared(file_get_contents($tablePath));

                BlogReview::unguard();
                $tablePath = public_path('db/_test/blog_post_review.sql');
                DB::unprepared(file_get_contents($tablePath));

            }else{
//                $this->call(BlogCategorySeeder::class);
//                $this->call(BlogPostSeeder::class);
//                $this->call(PivotSeeder::class);
            }
        }


        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            $this->call(PageSeeder::class);
        }


    }
}
