<?php

namespace App\AppPlugin\Config\Privacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederWebPrivacy extends Seeder {

    public function run(): void {
        WebPrivacy::unguard();
        $tablePath = public_path('db/config_web_privacies.sql');
        DB::unprepared(file_get_contents($tablePath));

        WebPrivacyTranslation::unguard();
        $tablePath = public_path('db/config_web_privacy_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
