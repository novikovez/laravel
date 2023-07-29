<?php

namespace App\Http\Services\DZ11\Methods;

class oddNumber
{
    public function getOddInt(array $data): array
    {
        return array_filter($data, function ($number) {
            return $number % 2 !== 0;
        });
    }
}
