<?php

namespace Tests\Unit\DZ11\DataProviders;

class dataProviderAService
{
    public static function provider(): array
    {
        return [
            [
                'data' => [10,5,7,9,55,11,20,21,25,35,40],
                'result' => [10,20,40],
                'expected' => 3
            ],
            [
                'data' => [11,17,13],
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
