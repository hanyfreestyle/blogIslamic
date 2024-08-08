<?php

namespace App\AppPlugin\Config\SiteMap;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleCodeSeeder extends Seeder {

    public function run(): void {
        GoogleCode::unguard();
        $tablePath = public_path('db/config_site_robots.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
