<?php

namespace App\Http\Services\Payments\Factory\DTO;

class CreateTokenDTO
{
    public function __construct(
        protected int $cardNumber,
        protected int $expMonth,
        protected int $expYear,
        protected int $cvc,
    )
    {
    }

    /**
     * @return int
     */
    public function getCardNumber(): int
    {
        return $this->cardNumber;
    }

    /**
     * @return int
     */
    public function getExpMonth(): int
    {
        return $this->expMonth;
    }

    /**
     * @return int
     */
    public function getExpYear(): int
    {
        return $this->expYear;
    }

    /**
     * @return int
     */
    public function getCvc(): int
    {
        return $this->cvc;
    }

}
