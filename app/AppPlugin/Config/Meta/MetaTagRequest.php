<?php

namespace App\AppPlugin\Config\Meta;

use Illuminate\Foundation\Http\FormRequest;

class MetaTagRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        $id = $this->route('id');

        if($id == '0') {
            $rules = ['cat_id' => "required|alpha_dash:ascii|min:4|max:50|unique:config_meta_tags"];
        } else {
            $rules = ['cat_id' => "required|alpha_dash:ascii|min:4|max:50|unique:config_meta_tags,cat_id,$id"];
        }

        foreach (config('app.web_lang') as $key => $lang) {
            $rules[$key . ".g_title"] = 'required';
            $rules[$key . ".g_des"] = 'required';
        }

        return $rules;
    }

}
