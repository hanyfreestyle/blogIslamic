<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MorePhotosRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {
        return [
            "image" => "required|array|min:1|max:5",
            'image.*' => 'required|mimes:jpg,jpeg,png,webp|max:1000',
        ];

    }

    public function messages() {
        return [

        ];
    }


}
