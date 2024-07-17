<?php


namespace App\AppCore\LangFile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LangFileRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array{
        $rules =[


        ];
        return $rules;
    }
}
