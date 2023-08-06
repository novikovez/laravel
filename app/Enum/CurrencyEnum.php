<?php

namespace App\Enum;

enum CurrencyEnum: int
{
    case USD = 1;
    case EUR = 2;

    public static function getValueId(string $name): CurrencyEnum
    {
        return match ($name) {
            'USD' => self::USD,
            'EUR' => self::EUR,
            default => null,
        };
    }

}
