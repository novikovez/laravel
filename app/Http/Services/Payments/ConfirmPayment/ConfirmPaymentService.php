<?php

namespace App\Http\Services\Payments\ConfirmPayment;

use Novikov7ua\Packagios\Enums\PaymentsEnum;
use App\Http\Services\Payments\ConfirmPayment\Handlers\CheckPaymentResultHandler;
use App\Http\Services\Payments\ConfirmPayment\Handlers\SavePaymentResultHandler;
use Illuminate\Pipeline\Pipeline;

class ConfirmPaymentService
{

    const HANDLERS = [
        CheckPaymentResultHandler::class,
        SavePaymentResultHandler::class,
    ];

    public function __construct(
        protected Pipeline $pipeline,
    )
    {
    }


    public function handle(PaymentsEnum $paymentsEnum, string $orderId)
    {
        $dto = new ConfirmPaymentDTO($paymentsEnum, $orderId);
        return $this->pipeline
            ->send($dto)
            ->through(self::HANDLERS)
            ->then(function (ConfirmPaymentDTO $confirmPaymentDTO){
                return $confirmPaymentDTO;
            });
    }
}
