<?php

namespace App\Http\Services\Payments\Factory\Module\PayPal;

use App\Enum\CurrencyEnum;
use App\Enum\PaymentStatusEnum;
use App\Http\Services\Payments\Factory\DTO\MakePaymentDTO;
use App\Http\Services\Payments\Factory\DTO\ValidatePaymentDTO;
use App\Http\Services\Payments\Factory\PaymentInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PayPalService implements PaymentInterface
{
    public function __construct(
        protected PayPalClient $payPalClient,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function validatePayment(string $paymentId): object
    {
        $this->payPalClient->setApiCredentials(config('paypal'));
        $paypalToken = $this->payPalClient->getAccessToken();
        $response = $this->payPalClient->capturePaymentOrder($paymentId);
        //dd($response);
        if(isset($response['error'])) {
            return (object)[
                'success' => false,
                'status' => PaymentStatusEnum::getValueId($response['error']['details'][0]['issue']),
                'description' => $response['error']['details'][0]['description'],
            ];

        }

        return (object)[
            'success' => true,
            'paymentId' => $response['id'],
            'orderId' => $response['purchase_units'][0]['payments']['captures'][0]['id'],
            'status' => PaymentStatusEnum::getValueId($response['status']),
            'email' => $response['payment_source']['paypal']['email_address'],
            'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
            'currency' => CurrencyEnum::getValueId(
                $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code']
            )
        ];
    }

    private function getCurrency(CurrencyEnum $currencyEnum): string
    {
        return match ($currencyEnum)
        {
            CurrencyEnum::USD => 'USD',
            CurrencyEnum::EUR => 'EUR'
        };
    }

    /**
     * @throws Throwable
     */
    public function createPayment(MakePaymentDTO $paymentDTO): string
    {
        $this->payPalClient->setApiCredentials(config('paypal'));
        $paypalToken = $this->payPalClient->getAccessToken();
        $response = $this->payPalClient->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $this->getCurrency($paymentDTO->getCurrency()),
                        "value" => number_format($paymentDTO->getAmount(), 2)
                    ]
                ]
            ]
        ]);
        if(isset($response['id']) && $response['id'] != null)
        {
            return $response['id'];
        }
        return '';
    }
}
