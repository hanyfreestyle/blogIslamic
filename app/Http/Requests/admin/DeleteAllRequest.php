<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DeleteAllRequest extends FormRequest{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array{
        return [
            "ids"    => "required|array|min:2|max:20",
        ];
    }

    public function messages(){
        return [
            'ids.required' => __('admin/alertMass.delete_all_required') ,
            'ids.min' => __('admin/alertMass.delete_all_min') ,
            'ids.max' => __('admin/alertMass.delete_all_max') ,
        ];
    }

}
