<?php

namespace App\Http\Traits;

trait DefCategoryTraits {

    static function LoadCategory() {
        $Cat = [];

        $Cat['gender'] = [
            (object)['id' => 1, 'name' => __('admin/defCat.gender_1')],
            (object)['id' => 2, 'name' => __('admin/defCat.gender_2')],
        ];

        $Cat['month'] = [
            (object)['id' => 1, "name" => __('admin/defCat.month_1')],
            (object)['id' => 2, "name" => __('admin/defCat.month_2')],
            (object)['id' => 3, "name" => __('admin/defCat.month_3')],
            (object)['id' => 4, "name" => __('admin/defCat.month_4')],
            (object)['id' => 5, "name" => __('admin/defCat.month_5')],
            (object)['id' => 6, "name" => __('admin/defCat.month_6')],
            (object)['id' => 7, "name" => __('admin/defCat.month_7')],
            (object)['id' => 8, "name" => __('admin/defCat.month_8')],
            (object)['id' => 9, "name" => __('admin/defCat.month_9')],
            (object)['id' => 10, "name" => __('admin/defCat.month_10')],
            (object)['id' => 11, "name" => __('admin/defCat.month_11')],
            (object)['id' => 12, "name" => __('admin/defCat.month_12')],
        ];


        return $Cat;
    }


}
