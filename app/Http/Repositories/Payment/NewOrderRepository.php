<?php

namespace App\Http\Repositories\Payment;

use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentDTO;
use Illuminate\Support\Facades\DB;
use Novikov7ua\Packagios\Enums\PaymentStatusEnum;
use Novikov7ua\Packagios\Payments\DTO\MakePaymentDTO;

class NewOrderRepository
{

    public function store(MakePaymentDTO $makePaymentDTO): bool
    {
        if(DB::table('order_payment_result')
            ->insert([
                'user_id' => auth()->user()->id,
                'payment_system' => $makePaymentDTO->getPaymentsEnum()->value,
                'order_id' => $makePaymentDTO->getOrderId(),
                'status' => PaymentStatusEnum::ORDER_NOT_APPROVED->value,
                'amount' => $makePaymentDTO->getAmount(),
                'currency' => $makePaymentDTO->getCurrency()->value,
                'created_at' => now()
            ])) {
            return true;
        }
        return false;
    }


}
