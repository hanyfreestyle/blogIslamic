<?php

namespace Database\Seeders;

use App\AppPlugin\BlogPost\Seeder\BlogPostWeb3Seeder;
use Illuminate\Database\Seeder;


class DatabaseWeb2Seeder extends Seeder {

    public function run(): void {
        $this->call(BlogPostWeb3Seeder::class);

    }
}
