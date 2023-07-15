<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryShowRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */


    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            "id.required" => "Вкажіть id",
            "id.integer" => "Вкажіть цілє число",
            "id.exists" => "Такого запису не існує",
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('category')
        ]);
    }
}
