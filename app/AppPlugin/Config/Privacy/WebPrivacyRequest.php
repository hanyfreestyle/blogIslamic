<?php

namespace App\AppPlugin\Config\Privacy;

use Illuminate\Foundation\Http\FormRequest;

class WebPrivacyRequest extends FormRequest {

  public function authorize(): bool {
    return true;
  }


  public function rules(): array {
    $rules = [
      'name' => "required",
    ];
    foreach (config('app.web_lang') as $key => $lang) {
      $rules[$key . ".h1"] = 'required';
    }
    return $rules;
  }

}
