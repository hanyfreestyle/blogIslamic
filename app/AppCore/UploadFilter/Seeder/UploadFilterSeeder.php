<?php

namespace App\AppCore\UploadFilter\Seeder;

use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UploadFilterSeeder extends Seeder {

    public function run(): void {

        UploadFilter::unguard();
        $tablePath = public_path('db/config_upload_filters.sql');
        DB::unprepared(file_get_contents($tablePath));

        UploadFilterSize::unguard();
        $tablePath = public_path('db/config_upload_filter_sizes.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
