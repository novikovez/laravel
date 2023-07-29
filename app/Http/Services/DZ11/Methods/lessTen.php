<?php

namespace App\Http\Services\DZ11\Methods;

class lessTen
{
    public function getLessTenInt(array $data): array
    {
         return array_filter($data, function ($number) {
            return $number < 10;
        });

    }
}
