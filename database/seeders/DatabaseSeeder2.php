<?php

namespace Database\Seeders;
use App\AppPlugin\BlogPost\Seeder\BlogTranslationSeeder2;
use Illuminate\Database\Seeder;


class DatabaseSeeder2 extends Seeder {

    public function run(): void {
        $this->call(BlogTranslationSeeder2::class);
    }

}
