<?php

namespace App\Http\Requests\Book;

use App\Enum\LangEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'string', 'max:255', 'min:3', 'unique:books'],
            "year" => ["required", "integer", "between:1970," . date('Y')],
            "lang" => ["required", "string", "max:2", Rule::enum(LangEnum::class)],
            'pages' => ['required', 'integer', 'max:55000', 'min:10'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле ім\'я обов\'язкове для заповнення',
            'name.string' => 'Поле ім\'я повинно бути рядком',
            'name.max' => 'Поле ім\'я не може перевищувати 255 символів',
            'name.min' => 'Поле ім\'я не може бути меншим за 3 символи',
            'name.unique' => 'Імя вжє зайнятє',
            'year.required' => 'Поле рік обов\'язкове для заповнення',
            'year.integer' => 'Поле рік повинно бути цілим числом',
            'year.between' => 'Поле рік повинно бути від поточного року до 1970',
            'lang.required' => 'Поле мова обов\'язкове для заповнення',
            'lang.string' => 'Поле мова повинно бути рядком',
            'lang.max' => 'Поле lang повинно бути 2 символи',
            'lang.in' => 'Поле lang повинно містити одне із значень en,ua,pl,de',
            'pages.required' => 'Поле сторінка обов\'язкове для заповнення',
            'pages.integer' => 'Поле сторінка повинно бути цілим числом',
            'pages.max' => 'Максимальне значення 55000',
            'pages.min' => 'Мінімальне значення 10',
            'category_id.required' => 'Поле категорія обов\'язкове для заповнення',
            'category_id.integer' => 'Поле категорія повинно бути числом',
            'category_id.exists' => 'Категорія повинна існувати',
        ];
    }
}
