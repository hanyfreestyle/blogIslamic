<?php

namespace Database\Seeders;
use App\AppPlugin\BlogPost\Seeder\BlogPostWeb2Seeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseWeb1Seeder extends Seeder {

    public function run(): void {
        $this->call(BlogPostWeb2Seeder::class);

    }
}
