<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', 'min:3', 'unique:categories,name,'.$this->route('category')],

        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Поле id обов\'язкове для заповнення',
            'id.integer' => 'Поле id повинно бути цілим числом',
            'id.exists' => 'Id не існує',
            'name.required' => 'Поле ім\'я обов\'язкове для заповнення',
            'name.string' => 'Поле ім\'я повинно бути рядком',
            'name.max' => 'Поле ім\'я не може перевищувати 255 символів',
            'name.min' => 'Поле ім\'я не може бути меншим за 3 символи',
            'name.unique' => 'Імя вжє зайнятє',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('category')
        ]);
    }
}
