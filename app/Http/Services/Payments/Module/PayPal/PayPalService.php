<?php

namespace App\Http\Services\Payments\Module\PayPal;

use App\Enum\CurrencyEnum;
use App\Http\Services\Payments\DTO\MakePaymentDTO;
use App\Http\Services\Payments\PaymentInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PayPalService implements PaymentInterface
{
    protected function __construct(
        protected PayPalClient $payPalClient,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function makePayment(MakePaymentDTO $paymentDTO): void
    {
        /// поки ставлю void, мабуть на наступному дз буду розуіти що потрібно віддати, та зміню
        $this->payPalClient->setApiCredentials(config('paypal'));
        $paypalToken = $this->payPalClient->getAccessToken();
        $response = $this->payPalClient->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $this->getCurrency($paymentDTO->getCurrency()),
                        "value" => number_format($paymentDTO->getAmount(), 2)
                    ]
                ]
            ]
        ]);
    }

    private function getCurrency(CurrencyEnum $currencyEnum): string
    {
        return match ($currencyEnum)
        {
            CurrencyEnum::USD => 'USD',
            CurrencyEnum::EUR => 'EUR'
        };
    }
}
