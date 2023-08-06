<?php

namespace App\Http\Controllers\Payment;

use App\Enum\PaymentsEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentMakeRequest;
use App\Http\Services\Payments\DTO\MakePaymentDTO;
use App\Http\Services\Payments\PaymentFactory;
use Illuminate\Contracts\Container\BindingResolutionException;

class PaymentController extends Controller
{

    public function __construct(
        protected PaymentFactory $paymentFactory,
    )
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function index(PaymentMakeRequest $request): void
    {
        /// поки ставлю void, мабуть на наступному дз буду розуіти що потрібно віддати, та зміню
        $request->validated();
        $makePaymentDTO = new MakePaymentDTO(...$request->validated());
        $paymentService = $this->paymentFactory->getInstance(PaymentsEnum::PAYPAL);
        $paymentService->makePayment($makePaymentDTO);
    }
}
