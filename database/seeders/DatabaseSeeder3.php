<?php

namespace Database\Seeders;

use App\AppPlugin\BlogPost\Seeder\BlogTranslationSeeder3;
use Illuminate\Database\Seeder;


class DatabaseSeeder3 extends Seeder {

    public function run(): void {
        $this->call(BlogTranslationSeeder3::class);
    }
}
