<?php

namespace App\Http\Services\Payments\Factory\DTO;

use App\Enum\PaymentStatusEnum;

class ValidatePaymentDTO
{
    public function __construct(
        protected string $orderId,
    )
    {
    }

}
