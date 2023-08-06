<?php

namespace App\Http\Services\Payments\Factory\Module\Stripe;

use App\Enum\CurrencyEnum;
use App\Http\Services\Payments\Factory\DTO\MakePaymentDTO;
use App\Http\Services\Payments\Factory\PaymentInterface;
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
    public function validatePayment(string $paymentId): bool
    {
        $result = $this->stripe->paymentIntents->retrieve($paymentId);

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

    /**
     * @throws ApiErrorException
     */
    public function createPayment(MakePaymentDTO $paymentDTO): string
    {
        $result = $this->stripe->paymentIntents->create([
            'amount' => $paymentDTO->getAmount() * 100,
            'currency' => $this->getCurrency($paymentDTO->getCurrency()),
        ]);
        return $result->client_secret;
    }
}
