<?php

namespace App\Http\Services\DZ11\Methods;

class moreTwentyFive
{
    public function getMoreTwentyFiveInt(array $data): array
    {
        return array_filter($data, function ($number) {
            return $number > 25;
        });
    }
}
