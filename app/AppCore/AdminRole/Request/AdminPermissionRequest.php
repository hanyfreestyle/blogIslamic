<?php

namespace App\AppCore\AdminRole\Request;

use Illuminate\Foundation\Http\FormRequest;

class AdminPermissionRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        $id = $this->route('id');

        if($id == '0') {
            $rules = [
                'name' => "required|alpha_dash:ascii|min:4|max:50|unique:permissions",
                'name_ar' => "required|min:3|max:50",
                'name_en' => "required|min:3|max:50",
//                'cat_id' => "required",
            ];
        } else {
            $rules = [
                'name' => "required|alpha_dash:ascii|min:4|max:50|unique:permissions,name,$id",
                'name_ar' => "required|min:3|max:50",
                'name_en' => "required|min:3|max:50",
//                'cat_id' => "required",
            ];
        }

        return $rules;
    }
}
