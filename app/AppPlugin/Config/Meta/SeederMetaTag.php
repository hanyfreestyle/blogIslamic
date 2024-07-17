<?php

namespace App\AppPlugin\Config\Meta;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederMetaTag extends Seeder {

    public function run(): void {

        MetaTag::unguard();
        $tablePath = public_path('db/config_meta_tags.sql');
        DB::unprepared(file_get_contents($tablePath));

        MetaTagTranslation::unguard();
        $tablePath = public_path('db/config_meta_tag_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
