<?php

namespace App\Http\Repositories\Payment;

use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentDTO;
use Illuminate\Support\Facades\DB;

class PaymentResultRepository
{
    public function store(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {

      return DB::table('order_payment_result')
          ->where('order_id', '=', $confirmPaymentDTO->getPaymentData()->orderId)
          ->update([
              'status' => $confirmPaymentDTO->getPaymentData()->status->value,
              'payment_id' => $confirmPaymentDTO->getPaymentData()->paymentId,
              'updated_at' => now()
          ]);
    }

    public function checkTotal(ConfirmPaymentDTO $confirmPaymentDTO): float
    {
        $base = DB::table('order_payment_result')
            ->select([
                "amount"
            ])
            ->where('order_id', '=', $confirmPaymentDTO->getPaymentData()->orderId)
            ->first();
        return $base->amount;
    }
}
