<?php


namespace App\AppCore\AdminRole\Seeder;

use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder {

    public function run(): void {

        $oldUsers = DB::connection('mysql2')->table('wp_users')->where('ID', '!=', 1)->get();

        $addDes = 'مرحبًا بكم في عالمي، حيث الكلمات ترشدكم إلى فهم أعماق أحلامكم. أنا [USERName]، المتخصص في تفسير الأحلام وكتابة المقالات المعلوماتية التي تضيء الجوانب المخفية وراء رموز وقصص أحلامنا.';
        $addDes .= "\n" . "بخلفية أكاديمية في علم النفس وعلم الاجتماع، أعمق في الأبعاد النفسية والثقافية التي تشكل عوالم أحلامنا. أسعى من خلال كتاباتي لتقديم تحليلات دقيقة ومفهومة، تساعد القراء على ربط تجاربهم الحلمية بواقع حياتهم.";
        $addDes .= "\n" . "من خلال مقالاتي، ستجدون دليلًا شاملًا لفهم الرسائل الخفية في الأحلام وكيفية تطبيق هذه الفهوم في تعزيز النمو الشخصي والوعي الذاتي. انضموا إلي في هذه الرحلة الاستكشافية لعالم الأحلام، حيث كل حلم هو بوابة لاكتشاف الذات.";

        foreach ($oldUsers as $old) {
            $user = new User();
            $user->name = $old->display_name;
            $user->slug = AdminHelper::Url_Slug($old->display_name);
            $user->email = $old->user_email;
            $user->password = Hash::make($old->user_email);
            $user->des = str_replace('[USERName]', $user->name, $addDes);
            $user->roles_name = ['editor'];


            $user->save();

            $role = Role::findByName('editor');
            $permissions = Permission::where('cat_id', 'Blog')->pluck('id');
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        }


    }
}
