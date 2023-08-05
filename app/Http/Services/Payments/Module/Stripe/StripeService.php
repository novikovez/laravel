<?php

namespace App\Http\Services\Payments\Module\Stripe;

use App\Enum\CurrencyEnum;
use App\Http\Services\Payments\DTO\MakePaymentDTO;
use App\Http\Services\Payments\Module\CardException;
use App\Http\Services\Payments\Module\Exception;
use App\Http\Services\Payments\PaymentInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService implements PaymentInterface
{
    public function __construct(
        protected StripeClient $stripe,
    ) {
    }

    /**
     * @throws ApiErrorException
     */
    public function makePayment(MakePaymentDTO $paymentDTO): bool
    {
        $result = $this->stripe->charges->create([
            'amount' => $paymentDTO->getAmount() * 100,
            'currency' => $this->getCurrency($paymentDTO->getCurrency()),
            'source' => 'tok_mastercard',
            'description' => $paymentDTO->getDescription(),
        ]);
        return $result->status === 'succeeded';
    }


    private function getCurrency(CurrencyEnum $currencyEnum): string
    {
        return match ($currencyEnum)
        {
            CurrencyEnum::USD => 'usd',
            CurrencyEnum::EUR => 'eur'
        };
    }

}
