<?php

namespace App\Http\Requests\def;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DefCategoryRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        $addLang = json_decode($data['add_lang']);
        $config = json_decode($data['config']);
        if ($config->categorySlug) {
            foreach ($addLang as $key => $lang) {
                data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
            }
        }
        $this->merge($data);
    }

    public function rules(Request $request): array {

        $addLang = json_decode($request->add_lang);
        $Config = json_decode($request->config);

        if ($Config->categorySlug) {
            foreach ($addLang as $key => $lang) {
                $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
            }
        }

        $id = $this->route('id');

        $rules = [
            'parent_id' => "nullable",
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000',
            'icon' => "nullable|mimes:jpg,jpeg,png,webp|max:1000",
        ];

        $rulesConfig = [
            'slug' => $Config->categorySlug,
            'des' => $Config->categoryDes,
            'seo' => $Config->categorySeo,
        ];

        $rules += AdminMainController::FormRequestSeo($id, $addLang, $Config->DbCategoryTrans, $Config->DbCategoryForeign, $rulesConfig);
        return $rules;
    }
}
