<?php

namespace App\AppCore\UploadFilter\Request;

use Illuminate\Foundation\Http\FormRequest;

class UploadFilterSizeRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        return [
            'type' => 'required',
            'new_h' => 'required|integer|between:20,1600',
            'new_w' => 'required|integer|between:20,1600',

            'canvas_back' => "required",
            'get_more_option' => 'required',
            'get_add_text' => 'required',
            'get_watermark' => 'required',
        ];
    }
}
