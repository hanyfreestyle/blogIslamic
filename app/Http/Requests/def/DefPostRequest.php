<?php

namespace App\Http\Requests\def;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DefPostRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        $addLang = json_decode($data['add_lang']);
        $config = json_decode($data['config']);
        if ($config->postSlug) {
            foreach ($addLang as $key => $lang) {
                data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
            }
        }
        $this->merge($data);
    }

    public function rules(Request $request): array {
        $addLang = json_decode($request->add_lang);
        $Config = json_decode($request->config);

        if ($Config->postSlug) {
            foreach ($addLang as $key => $lang) {
                $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
            }
        }

        $id = $this->route('id');

        $rules = [
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000',
        ];

        if ($Config->TableCategory) {
            $rules["categories"] = 'required|array|min:1';
        }

        if ($Config->postPublishedDate) {
            if ($id == '0') {
                $rules["published_at"] = "nullable|date_format:Y-m-d";
            } else {
                $rules["published_at"] = "required|date_format:Y-m-d";
            }
        }


        $rulesConfig = [
            'slug' => $Config->postSlug,
            'des' => $Config->postDes,
            'seo' => $Config->postSeo,
        ];

        $rules += AdminMainController::FormRequestSeo($id, $addLang, $Config->DbPostTrans, $Config->DbPostCatId, $rulesConfig);

        return $rules;
    }
}
