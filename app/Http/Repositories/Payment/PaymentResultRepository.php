<?php

namespace App\Http\Repositories\Payment;

use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentDTO;
use Illuminate\Support\Facades\DB;
use Novikov7ua\Packagios\Enums\PaymentStatusEnum;

class PaymentResultRepository
{

    public function store(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {
        if($this->checkStatus($confirmPaymentDTO) === true AND $this->checkTotal($confirmPaymentDTO) === true)
        {
            if(DB::table('order_payment_result')
                ->where('order_id', '=', $confirmPaymentDTO->getPaymentData()->orderId)
                ->update([
                    'status' => $confirmPaymentDTO->getPaymentData()->status->value,
                    'payment_id' => $confirmPaymentDTO->getPaymentData()->paymentId,
                    'updated_at' => now()
                ])) {
                return true;
            }
        }
        return false;
    }

    private function checkStatus(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {
        if($confirmPaymentDTO->getPaymentData()->status->name === PaymentStatusEnum::tryFrom(1)->name)
        {
            return true;
        }
        return false;
    }

    private function checkTotal(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {
        $base = DB::table('order_payment_result')
            ->select([
                "amount"
            ])
            ->where('order_id', '=', $confirmPaymentDTO->getPaymentData()->orderId)
            ->first();

        if($base->amount === floatval($confirmPaymentDTO->getPaymentData()->amount))
        {
            return true;
        }
        return false;
    }
}
