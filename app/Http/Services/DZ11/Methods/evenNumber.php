<?php

namespace App\Http\Services\DZ11\Methods;

class evenNumber
{
    public function getEvenInt(array $data): array
    {
        return array_filter($data, function ($number) {
            return $number % 2 === 0;
        });
    }
}
