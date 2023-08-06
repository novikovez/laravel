<?php

namespace App\Http\Services\Payments;

use App\Http\Services\Payments\DTO\MakePaymentDTO;

interface PaymentInterface
{

    public function makePayment(MakePaymentDTO $paymentDTO);
}
