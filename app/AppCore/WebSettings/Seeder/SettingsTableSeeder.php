<?php

namespace App\AppCore\WebSettings\Seeder;

use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder {
    public function run(): void {
        Setting::unguard();
        $tablePath = public_path('db/config_settings.sql');
        DB::unprepared(file_get_contents($tablePath));

        SettingTranslation::unguard();
        $tablePath = public_path('db/config_setting_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
