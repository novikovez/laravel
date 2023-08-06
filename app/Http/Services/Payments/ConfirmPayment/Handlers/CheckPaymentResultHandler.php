<?php

namespace App\Http\Services\Payments\ConfirmPayment\Handlers;

use App\Http\Services\Payments\ConfirmPayment\confirmPaymentDTO;
use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentInterface;
use App\Http\Services\Payments\Factory\PaymentFactory;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;

class CheckPaymentResultHandler implements ConfirmPaymentInterface
{
    public function __construct(
        protected PaymentFactory $paymentFactory
    )
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next)
    {
        $paymentService = $this->paymentFactory->getInstance(
            $confirmPaymentDTO->getPaymentsEnum()
        );
        $result = $paymentService->validatePayment($confirmPaymentDTO->getPaymentId());
        $confirmPaymentDTO->setPaymentData($result);
        return $next($confirmPaymentDTO);
    }
}
