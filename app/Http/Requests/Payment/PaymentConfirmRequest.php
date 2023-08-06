<?php

namespace App\Http\Requests\Payment;

use App\Enum\CurrencyEnum;
use App\Enum\PaymentsEnum;
use App\Rules\UniquePayment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentConfirmRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'paymentId' => ['required', 'string', 'unique:order_payment_result,payment_id'],
        ];
    }

}
