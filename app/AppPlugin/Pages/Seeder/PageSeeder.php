<?php

namespace App\AppPlugin\Pages\Seeder;


use App\AppPlugin\Pages\Models\Page;
use App\AppPlugin\Pages\Models\PageCategory;
use App\AppPlugin\Pages\Models\PageCategoryTranslation;
use App\AppPlugin\Pages\Models\PagePhoto;
use App\AppPlugin\Pages\Models\PagePhotoTranslation;
use App\AppPlugin\Pages\Models\PagePivot;
use App\AppPlugin\Pages\Models\PageTags;
use App\AppPlugin\Pages\Models\PageTagsPivot;
use App\AppPlugin\Pages\Models\PageTagsTranslation;
use App\AppPlugin\Pages\Models\PageTranslation;
use App\AppPlugin\Pages\Traits\PageConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PageSeeder extends Seeder {

    public function run(): void {
        $Config = PageConfigTraits::DbConfig();

        if ($Config['TableCategory']) {
            PageCategory::unguard();
            $tablePath = public_path('db/page_categories.sql');
            DB::unprepared(file_get_contents($tablePath));

            PageCategoryTranslation::unguard();
            $tablePath = public_path('db/page_category_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if ($Config['TableTags']) {
            PageTags::unguard();
            $tablePath = public_path('db/page_tags.sql');
            DB::unprepared(file_get_contents($tablePath));

            PageTagsTranslation::unguard();
            $tablePath = public_path('db/page_tags_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        Page::unguard();
        $tablePath = public_path('db/page_pages.sql');
        DB::unprepared(file_get_contents($tablePath));

        PageTranslation::unguard();
        $tablePath = public_path('db/page_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

        if ($Config['TableCategory']) {
            PagePivot::unguard();
            $tablePath = public_path('db/pagecategory_page.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if($Config['TableTags']){
            PageTagsPivot::unguard();
            $tablePath = public_path('db/page_tags_post.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if ($Config['TableMorePhotos']) {

            PagePhoto::unguard();
            $tablePath = public_path('db/page_photos.sql');
            DB::unprepared(file_get_contents($tablePath));

            PagePhotoTranslation::unguard();
            $tablePath = public_path('db/page_photo_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }


    }
}
