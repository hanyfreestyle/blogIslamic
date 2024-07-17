<?php

namespace App\AppPlugin\FileManager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UploadPhotosRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {
        return [
            "path" => 'required_if:new_folder,=,null',
            "new_folder" => 'nullable|required_if:path,=,null|min:3',
            "image" => "required|array|min:1|max:10",
            'image.*' => 'required|mimes:jpg,jpeg,png|max:1000',
        ];

    }

    public function messages() {
        return [
            'path.required' =>  trans('admin/fileManager.form_sel_folder'),
            'image.required' =>  trans('admin/fileManager.form_req_photo'),
            'new_folder.required_if' =>  trans('admin/fileManager.form_req_photo'),
            'path.required_if' =>  trans('admin/fileManager.form_req_if_path'),
        ];
    }


}
