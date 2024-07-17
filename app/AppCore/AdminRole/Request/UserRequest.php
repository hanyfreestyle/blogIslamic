<?php

namespace App\AppCore\AdminRole\Request;


use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        data_set($data, 'slug', AdminHelper::Url_Slug($data['slug']));
        $this->merge($data);
    }

    public function rules(Request $request): array {

        $request->merge(['slug' => AdminHelper::Url_Slug($request->slug)]);

        $id = $this->route('id');

        if ($id == '0') {
            $rules = [
                'name' => "required|min:4|max:50",
                'slug' => "required|min:3|max:50|unique:users",
                'roles' => 'required',
                'email' => "required|email|unique:users",
                'phone' => "numeric|nullable",
                'user_password' => "required|confirmed|min:8",
                'image' => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',
                /*
                                'user_password' => ['required', Password::min(8)
                                    ->mixedCase()
                                    ->letters()
                                    ->numbers()
                                    ->symbols()
                                    ->uncompromised(),
                                ],
                */
            ];
        } else {
            $rules = [
                'name' => "required|min:4|max:50",
                'slug' => "required|min:3|max:50|unique:users,slug,$id",
                'roles' => 'required',
                'email' => "required|email|unique:users,email,$id",
                'phone' => "numeric|nullable",
                'user_password' => "confirmed|min:8|nullable",
                'image' => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',

            ];
        }

        return $rules;
    }

    public function messages() {
        return [
            'roles.required' => __('admin/config/roles.users_fr_role_selone'),
        ];
    }

}
