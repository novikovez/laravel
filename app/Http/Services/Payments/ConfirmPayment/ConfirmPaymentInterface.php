<?php

namespace App\Http\Services\Payments\ConfirmPayment;

use Closure;

interface ConfirmPaymentInterface
{
    public function handle(confirmPaymentDTO $confirmPaymentDTO, Closure $next);
}
