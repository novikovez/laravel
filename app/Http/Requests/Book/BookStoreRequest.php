<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'year' => ['required', 'int'],
            'countPages' => ['required', 'int'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле ім\'я обов\'язкове для заповнення',
            'name.string' => 'Поле ім\'я повинно бути рядком',
            'name.max' => 'Поле ім\'я не може перевищувати 255 символів',
            'author.required' => 'Поле автор обов\'язкове для заповнення',
            'author.string' => 'Поле автор повинно бути рядком',
            'author.max' => 'Поле автор не може перевищувати 255 символів',
            'year.required' => 'Поле рік обов\'язкове для заповнення',
            'year.integer' => 'Поле рік повинно бути цілим числом',
            'countPages.required' => 'Поле кількість сторінок обов\'язкове для заповнення',
            'countPages.integer' => 'Поле кількість сторінок повинно бути цілим числом',
        ];
    }
}
