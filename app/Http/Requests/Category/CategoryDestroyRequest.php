<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:categories'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Поле id обов\'язкове для заповнення',
            'id.integer' => 'Поле id повинно бути цілим числом',
            'id.exists' => 'Id не існує',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('category')
        ]);
    }
}

