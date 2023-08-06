<?php

namespace App\Http\Services\Payments\Factory;

use App\Enum\PaymentsEnum;
use App\Http\Services\Payments\Factory\Module\PayPal\PayPalService;
use App\Http\Services\Payments\Factory\Module\Stripe\StripeService;
use Illuminate\Contracts\Container\BindingResolutionException;


class PaymentFactory
{
    /**
     * @throws BindingResolutionException
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
