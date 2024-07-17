<?php

namespace App\AppCore\AdminRole\Seeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {

    public function run(): void {

        $data = [
            ['name' => 'editor', 'name_ar' => 'محرر', 'name_en' => 'editor'],
            ['name' => 'supervisor', 'name_ar' => 'مشرف', 'name_en' => 'supervisor'],
        ];

        $countData = Role::all()->count();
        if($countData == '1') {
            foreach ($data as $key => $value) {
                Role::create($value);
            }
        }
    }

}
