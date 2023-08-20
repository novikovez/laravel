<?php

namespace App\Http\Services\Payments\ConfirmPayment\Handlers;

use App\Http\Repositories\Payment\PaymentResultRepository;
use App\Http\Services\Payments\ConfirmPayment\confirmPaymentDTO;
use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentInterface;
use Closure;
use Novikov7ua\Packagios\Enums\PaymentStatusEnum;

class SavePaymentResultHandler implements ConfirmPaymentInterface
{
    public function __construct(
        protected PaymentResultRepository $paymentResultRepository
    )
    {
    }

    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next)
    {
        if($this->checkStatus($confirmPaymentDTO) === true AND $this->checkTotal($confirmPaymentDTO) > 0) {
            $this->paymentResultRepository->store($confirmPaymentDTO);
            return $next($confirmPaymentDTO);
        }
        return $confirmPaymentDTO;
    }

    public function checkTotal(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {
        $getDbTotal = $this->paymentResultRepository->checkTotal($confirmPaymentDTO);
        if($getDbTotal === floatval($confirmPaymentDTO->getPaymentData()->amount))
        {
            return true;
        }
        return false;
    }

    private function checkStatus(ConfirmPaymentDTO $confirmPaymentDTO): bool
    {
        if($confirmPaymentDTO->getPaymentData()->status->name === PaymentStatusEnum::COMPLETED->name)
        {
            return true;
        }
        return false;
    }
}
