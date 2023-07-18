<?php

namespace App\Enum;

enum LangEnum: string
{
    case EN = 'en';
    case PL = 'pl';
    case UA = 'ua';
    case DE = 'de';

    public static function getValues(): array
    {
        return [
            self::EN,
            self::PL,
            self::UA,
            self::DE,
        ];
    }
}
