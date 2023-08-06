<?php

namespace App\Http\Services\Payments;

use App\Enum\PaymentsEnum;
use App\Http\Services\Payments\Module\PayPal\PayPalService;
use App\Http\Services\Payments\Module\Stripe\StripeService;
use Illuminate\Contracts\Container\BindingResolutionException;

class PaymentFactory
{
    /**
     * @throws BindingResolutionException
     */
    public function getInstance(PaymentsEnum $paymentsEnum): PaymentInterface
    {
        return match ($paymentsEnum)
        {
            PaymentsEnum::PAYPAL => app()->make(PayPalService::class),
            PaymentsEnum::STRIPE => app()->make(StripeService::class),
        };
    }
}
