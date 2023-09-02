<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class AuthorShowIteratorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */


    public function rules(): array
    {
        return [
            'last_id' => ['required', 'integer', 'exists:authors,id'],
        ];
    }

    public function messages(): array
    {
        return [
            "last_id.required" => "Вкажіть last_id",
            "last_id.integer" => "Вкажіть цілє число",
            "last_id.exists" => "Такого запису не існує",
        ];
    }
}
