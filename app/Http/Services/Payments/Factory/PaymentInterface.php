<?php

namespace App\Http\Services\Payments\Factory;

use App\Http\Services\Payments\Factory\DTO\MakePaymentDTO;

interface PaymentInterface
{

    public function validatePayment(string $paymentId);
    public function createPayment(MakePaymentDTO $paymentDTO): string;
}
