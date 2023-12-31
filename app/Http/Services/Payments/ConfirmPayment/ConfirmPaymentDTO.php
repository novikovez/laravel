<?php

namespace App\Http\Services\Payments\ConfirmPayment;

use Novikov7ua\Packagios\Enums\PaymentsEnum;

class ConfirmPaymentDTO
{
    protected bool $success;
    protected object $paymentData;

    /**
     * @return object
     */
    public function getPaymentData(): object
    {
        return $this->paymentData;
    }

    /**
     * @param object $paymentData
     */
    public function setPaymentData(object $paymentData): void
    {
        $this->paymentData = $paymentData;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function __construct(
        protected PaymentsEnum $paymentsEnum,
        protected string $orderId
    )
    {
    }

    /**
     * @return PaymentsEnum
     */
    public function getPaymentsEnum(): PaymentsEnum
    {
        return $this->paymentsEnum;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
