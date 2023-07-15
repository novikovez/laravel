<?php

namespace App\Http\Requests\Book;

use App\Enum\LangEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BookIndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            "startDate" => ["required", "date_format:Y.m.d", "before:endDate"],
            'endDate' => ["required", "date_format:Y.m.d", "after:startDate"],
            "year" => ["sometimes", "integer", "nullable", "between:1970," . date('Y')],
            "lang" => ["sometimes", "string", "max:2", new Enum(LangEnum::class), "nullable"],
        ];
    }

    public function messages(): array
    {
        return [
            "startDate.required" => "Вкажіть дату",
            "startDate.date_format" => "Вкажіть корректну дату рік-місяць-день",
            "startDate.before" => "Вкажіть дату меншу за фінальну",
            "endDate.required" => "Вкажіть дату",
            "endDate.date_format" => "Вкажіть корректну дату рік-місяць-день",
            "endDate.after" => "Вкажіть дату більшу за початкову",
            "year.integer" => "Вкажіть корректний рік",
            "year.between" => "Вкажіть корректний рік в діапазоні " . date('Y') . "-1970",
            "lang.string" => "Цє не строка",
            "lang.max" => "Ця строка білшє 2 символів",
            "lang.in" => "Допустимі значення en,ua,pl,de",
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->missing('lang')) {
            $this->merge(['lang' => null]);
        }
        if ($this->missing('year')) {
            $this->merge(['year' => null]);
        }
    }
}
