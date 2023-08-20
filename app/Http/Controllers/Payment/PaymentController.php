<?php

namespace App\Http\Controllers\Payment;


use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentConfirmRequest;
use App\Http\Services\Payments\ConfirmPayment\ConfirmPaymentService;
use App\Http\Services\Payments\Order\NewOrderService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Throwable;
use Novikov7ua\Packagios\Payments\DTO\MakePaymentDTO;
use Novikov7ua\Packagios\Payments\PaymentFactory;
use Novikov7ua\Packagios\Enums\CurrencyEnum;
use Novikov7ua\Packagios\Enums\PaymentsEnum;

class PaymentController extends Controller
{

    public function __construct(
        protected PaymentFactory $paymentFactory,
        protected NewOrderService $newOrderService
    )
    {
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function createPayment(int $system): JsonResponse
    {
        $paymentService = $this->paymentFactory->getInstance(PaymentsEnum::from($system), config('payments'));
        $makePaymentDTO = new MakePaymentDTO(
            17.5,
            CurrencyEnum::USD,
            PaymentsEnum::from($system)
        );
        $orderId = $paymentService->createPayment($makePaymentDTO);
        $makePaymentDTO->setOrderId($orderId);
        $this->newOrderService->store($makePaymentDTO);
        return response()->json([
            'order' => [
                'id'=>$orderId
            ]
        ]);
    }

    /**
     */
    public function confirmPayment(
        PaymentConfirmRequest $request,
        int $system,
        ConfirmPaymentService $confirmPaymentService,
    )
    {
        $data = $request->validated();
        $result = $confirmPaymentService->handle(PaymentsEnum::from($system), $data['order_id']);
        return response()->json([
            'status' => $result->getPaymentData()->success,
        ]);
    }
}
