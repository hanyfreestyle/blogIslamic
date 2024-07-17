<?php
return [
    'adminFile' => [
        'admin'=> ['id'=> 'admin' , 'group'=>null ,'file_name'=> 'admin', 'name_en'=> "Admin Core" ,'name_ar'=> "لوحة التحكم " ],
        'webConfig'=> ['id'=> 'webConfig' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'webConfig','name'=>'web Config','name_ar'=>'اعدادات الموقع' ],
        'upFilter'=> ['id'=> 'upFilter' , 'group'=>'admin','sub_dir'=> 'config','file_name'=> 'upFilter','name'=>'Photo Filter','name_ar'=>'فلاتر الصور' ],
        'settings'=> ['id'=> 'settings' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'settings','name'=>'Settings','name_ar'=>'اعدادات الاقسام' ],
//        'dataTable'=> ['id'=> 'dataTable' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'dataTable','name'=>'dataTable','name_ar'=>'dataTable' ],
        'roles'=> ['id'=> 'roles' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'roles','name'=>'Permissions','name_ar'=>'الصلاحيات' ],
        'alertMass'=> ['id'=> 'alertMass' ,'group'=>'admin','file_name'=> 'alertMass','name_en'=>'Alert Mass','name_ar'=>'رسائل التحذير' ],
        'deleteMass'=> ['id'=> 'deleteMass','group'=>'admin','file_name'=>'deleteMass','name'=>'Delete Mass','name_ar'=>'رسائل الحذف' ],
        'form'=> ['id'=> 'form' , 'group'=>'admin' , 'file_name'=> 'form','name_en'=>'Forms','name_ar'=>'الفورم' ],
        'def' => ['id'=> 'def' , 'group'=>'admin' , 'file_name'=> 'def','name_en'=>'Default Variables','name_ar'=>'المتغيرات الاساسية' ],
        'filter'=> ['id'=> 'filter', 'group'=>'admin', 'file_name'=> 'formFilter','name_en'=>'Filter Form','name_ar'=>'فلتر' ],
        'defCat'=> ['id'=> 'defCat', 'group'=>'admin', 'file_name'=> 'defCat','name_en'=>'defCat', 'name_ar'=>'defCat' ],
    ],

    'webFile' => [
        'menu'=> ['id'=> 'menu' , 'group'=>'web','file_name'=> 'menu','name_en'=>'Menu','name_ar'=>'القائمة' ],
        'def'=> ['id'=> 'def' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'def','name_en'=>'Default Variables','name_ar'=>'المتغيرات الاساسية' ],

    ],


];
