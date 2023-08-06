<?php

namespace App\Enum;

enum PaymentStatusEnum: int
{
    case COMPLETED = 1;
    case ORDER_NOT_APPROVED = 2;
    case ORDER_ALREADY_CAPTURED = 3;
    public static function getValueId(string $name): PaymentStatusEnum
    {
        return match ($name) {
            'COMPLETED' => self::COMPLETED,
            'ORDER_NOT_APPROVED' => self::ORDER_NOT_APPROVED,
            'ORDER_ALREADY_CAPTURED' => self::ORDER_ALREADY_CAPTURED,
            default => null,
        };
    }
}


