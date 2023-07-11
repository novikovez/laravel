<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'countPages' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Поле ім\'я обов\'язкове для заповнення',
            'id.integer' => 'Поле id повинно бути цілим числом',
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('book')
        ]);
    }
}
