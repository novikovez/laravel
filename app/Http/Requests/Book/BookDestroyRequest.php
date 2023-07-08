<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookDestroyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Поле id обов\'язкове для заповнення',
            'id.integer' => 'Поле id повинно бути цілим числом',
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}