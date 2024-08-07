<?php

namespace Database\Seeders;



use App\AppPlugin\BlogPost\Seeder\BlogTranslationSeeder4;
use Illuminate\Database\Seeder;


class DatabaseSeeder4 extends Seeder {

    public function run(): void {
        $this->call(BlogTranslationSeeder4::class);

    }
}
