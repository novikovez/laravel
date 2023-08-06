<?php

namespace App\Http\Requests\Payment;

use App\Enum\CurrencyEnum;
use App\Enum\PaymentsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentMakeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:0', 'max:9999'],
            'currency' => ['required', Rule::enum(CurrencyEnum::class)],
            'description' => ['sometimes', 'max:255'],
            'paySystem' => ['required', Rule::enum(PaymentsEnum::class)]
        ];
    }

}
