<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MorePhotosEditRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {
        return [
            "image" => "nullable|mimes:jpg,jpeg,png,webp|max:1000",
        ];

    }

    public function messages() {
        return [

        ];
    }


}
