<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookIndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "startDate" => ["required", "date_format:d.m.Y"],
            'endDate' => ["required", "date_format:d.m.Y", "after:startDate"],
            "year" => ["sometimes", "integer", "between:1970,".date('Y')],
            "lang" => ["sometimes", "string", "max:2", "in:en,ua,pl,de"],
        ];
    }

    public function messages(): array
    {
        return [
            "startDate.required" => "Вкажіть дату",
            "startDate.date_format" => "Вкажіть корректну дату",
            "endDate.required" => "Вкажіть дату",
            "endDate.date_format" => "Вкажіть корректну дату",
            "endDate.after" => "Вкажіть дату більшу за початкову",
            "year.integer" => "Вкажіть корректний рік",
            "year.between" => "Вкажіть корректний рік в діапазоні ".date('Y')."-1970",
            "lang.string" => "Цє не строка",
            "lang.max" => "Ця строка білшє 2 символів",
            "lang.in" => "Допустимі значення en,ua,pl,de",
        ];
    }
}
