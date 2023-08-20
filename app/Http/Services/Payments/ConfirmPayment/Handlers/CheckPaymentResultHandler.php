<?php

namespace App\Http\Services\Payments\ConfirmPayment\Handlers;

use App\Http\Services\Payments\ConfirmPayment\confirmPaymentDTO;
use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentInterface;
use Novikov7ua\Packagios\Payments\PaymentFactory;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Throwable;

class CheckPaymentResultHandler implements ConfirmPaymentInterface
{
    public function __construct(
        protected PaymentFactory $paymentFactory
    )
    {
    }

    /**
     * @throws BindingResolutionException|Throwable
     */
    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next)
    {
        $paymentService = $this->paymentFactory->getInstance(
            $confirmPaymentDTO->getPaymentsEnum(),
            config('payments')
        );
        $result = $paymentService->getPaymentInfo($confirmPaymentDTO->getOrderId());
        $confirmPaymentDTO->setPaymentData($result);
        return $next($confirmPaymentDTO);
    }
}
