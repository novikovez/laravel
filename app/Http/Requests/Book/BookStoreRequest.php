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
            'name.required' => 'Поле имя обязательно для заполнения',
            'name.string' => 'Поле имя должно быть строкой',
            'name.max' => 'Поле имя не может превышать 255 символов',
            'author.required' => 'Поле автор обязательно для заполнения',
            'author.string' => 'Поле автор должно быть строкой',
            'author.max' => 'Поле автор не может превышать 255 символов',
            'year.required' => 'Поле год обязательно для заполнения',
            'year.int' => 'Поле год должно быть целым числом',
            'countPages.required' => 'Поле количество страниц обязательно для заполнения',
            'countPages.int' => 'Поле количество страниц должно быть целым числом',
        ];
    }
}
