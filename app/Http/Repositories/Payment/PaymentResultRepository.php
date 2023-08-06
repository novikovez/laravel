<?php

namespace App\Http\Repositories\Payment;

use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentDTO;
use Illuminate\Support\Facades\DB;

class PaymentResultRepository
{

    public function store(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {
        if(DB::table('order_payment_result')
            ->insert([
                'user_id' => auth()->user()->id,
                'payment_system' => $confirmPaymentDTO->getPaymentsEnum()->value,
                'payment_id' => $confirmPaymentDTO->getPaymentId(),
                'order_id' => $confirmPaymentDTO->getPaymentData()->orderId,
                'success' => $confirmPaymentDTO->getPaymentData()->success,
                'status' => $confirmPaymentDTO->getPaymentData()->status->value,
                'amount' => $confirmPaymentDTO->getPaymentData()->amount,
                'currency' => $confirmPaymentDTO->getPaymentData()->currency,
                'created_at' => now()
            ])) {
            return true;
        }
        return false;
    }


}
