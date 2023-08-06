<?php

namespace App\Http\Services\Payments\ConfirmPayment\Handlers;

use App\Http\Repositories\Payment\PaymentResultRepository;
use App\Http\Services\Payments\ConfirmPayment\confirmPaymentDTO;
use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentInterface;
use Closure;

class SavePaymentResultHandler implements ConfirmPaymentInterface
{
    public function __construct(
        protected PaymentResultRepository $paymentResultRepository
    )
    {
    }

    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next)
    {
        //dd($confirmPaymentDTO->getPaymentData()->success);
        if($confirmPaymentDTO->getPaymentData()->success === true) {
            $this->paymentResultRepository->store($confirmPaymentDTO);

        }
        return $next($confirmPaymentDTO);
    }
}
