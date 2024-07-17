<?php

namespace App\AppCore\AdminRole\Seeder;

use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder {

    public function run(): void {

        $name = "هانى درويش";
        $user = User::create([
            'name' => $name,
            'slug' => AdminHelper::Url_Slug($name),
            'email' => 'hany.freestyle4u@gmail.com',
            'password' => Hash::make('hany.freestyle4u@gmail.com'),
            'roles_name' => ['admin'],
        ]);

        $role = Role::create(['name' => 'admin', 'name_ar' => 'ادمن كامل الصلاحيات', 'name_en' => 'Full Admin Permission ']);

        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }
}
