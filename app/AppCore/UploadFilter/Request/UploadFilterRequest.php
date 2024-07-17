<?php

namespace App\AppCore\UploadFilter\Request;

use Illuminate\Foundation\Http\FormRequest;

class UploadFilterRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {

        return [
            'name' => 'required',
            'type' => 'required',
            'new_h' => 'required|integer|between:20,1600',
            'new_w' => 'required|integer|between:20,1600',
            "quality_val" => "required|integer|between:45,99",
            #'canvas_back' => "required|regex:/^(?:[0-9a-fA-F]{3,4}){1,2}$/",
            'canvas_back' => "required",
            "blur_size" => "required|integer|between:0,100",
            "pixelate_size" => "required|integer|between:5,20",
            'text_state' => "required",

            "text_print" => "required_if:text_state,==,1|min:6|max:50|nullable",
            "font_path" => "required_if:text_state,==,1|nullable",
            "font_size" => "required_if:text_state,==,1|integer|between:12,50|nullable",
            "text_position" => "required_if:text_state,==,1|nullable",
            'font_color' => "required_if:text_state,==,1|nullable",
            "font_opacity" => "required_if:text_state,==,1|integer|between:10,100|nullable",

            'watermark_state' => "required",
            "watermark_img" => "required_if:watermark_state,==,1|nullable",
            "watermark_position" => "required_if:watermark_state,==,1|nullable",
        ];
    }


    public function messages() {
        return [
            'text_print.required_if' => 'برجاء تحديد النص المستخدم',
            'text_position.required_if' => 'مطلوب',
            'font_path.required_if' => 'مطلوب',
            'font_opacity.required_if' => 'مطلوب',
            'font_color.required_if' => 'مطلوب',
            'font_size.required_if' => 'مطلوب',
            'watermark_img.required_if' => 'مطلوب',
            'watermark_position.required_if' => 'مطلوب',

        ];
    }

}
