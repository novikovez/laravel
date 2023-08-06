<?php

namespace App\Http\Controllers\Payment;

use App\Enum\CurrencyEnum;
use App\Enum\PaymentsEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentConfirmRequest;
use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentService;
use App\Http\Services\Payments\Factory\DTO\MakePaymentDTO;
use App\Http\Services\Payments\Factory\PaymentFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

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
    public function createPayment(int $system): JsonResponse
    {

        $paymentService = $this->paymentFactory->getInstance(PaymentsEnum::from($system));
        $makePaymentDTO = new MakePaymentDTO(
            17.5,
            CurrencyEnum::USD
        );
        $orderId = $paymentService->createPayment($makePaymentDTO);
        //$paymentService->makePayment($makePaymentDTO);
        return response()->json([
            'order' => [
                'id'=>$orderId
            ]
        ]);
    }

    /**
     * @throws BindingResolutionException
     */
    public function confirmPayment(
        PaymentConfirmRequest $request,
        int $system,
        ConfirmPaymentService $confirmPaymentService,
    )
    {
        $data = $request->validated();
        $confirmPaymentService->handle(PaymentsEnum::from($system), $data['paymentId']);

    }
}
