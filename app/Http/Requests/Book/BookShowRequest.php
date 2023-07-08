<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookShowRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */



    public function rules(): array
    {
        return [
            'id' => ['required', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            "id.required" => "Вкажіть ідентифікатор",
            "id.integer" => "Ідентифікатор повинен бути цілим числом",
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}