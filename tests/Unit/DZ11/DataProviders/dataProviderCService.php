<?php

namespace Tests\Unit\DZ11\DataProviders;

class dataProviderCService
{
    public static function provider(): array
    {
        return [
            [
                'data' => [10,5,7,9,55,11,20,21,25,35,40],
                'result' => [5,7,9],
                'expected' => 3,
            ],
            [
                'data' => [10,16,12],
                'result' => [],
                'expected' => 0,
            ],
            [
                'data' => [],
                'result' => [],
                'expected' => 0,
            ],

        ];
    }
}
