<?php

namespace App\Http\Services\Payments\Order;

use App\Http\Repositories\Payment\NewOrderRepository;
use Novikov7ua\Packagios\Payments\DTO\MakePaymentDTO;

class NewOrderService
{
    public function __construct(
        protected NewOrderRepository $newOrderRepository,
    )
    {
    }

    public function store(MakePaymentDTO $makePaymentDTO)
    {
        return $this->newOrderRepository->store($makePaymentDTO);
    }
}
