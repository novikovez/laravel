<?php

namespace App\Http\Services\Payments\DTO;

use App\Enum\CurrencyEnum;
class MakePaymentDTO
{
    public function __construct(
        protected float $amount,
        protected CurrencyEnum $currency,
        protected string $description = '',
    )
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return CurrencyEnum
     */
    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }
}
