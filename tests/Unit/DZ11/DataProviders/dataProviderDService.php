<?php

namespace Tests\Unit\DZ11\DataProviders;

class dataProviderDService
{
    public static function provider(): array
    {
        return [
            [
                'data' => [10,5,7,9,55,11,20,21,25,35,40,50],
                'result' => [
                    'getEvenInt' => [10,20,40,50],
                    'getMoreTwentyFiveInt' => [40,50]
                ],
                'expected' => 2,
            ],
            [
                'data' => [10,16,12],
                'result' => [
                    'getEvenInt' => [10,16,12],
                    'getMoreTwentyFiveInt' => []
                ],
                'expected' => 0,
            ],
            [
                'data' => [],
                'result' => [
                    'getEvenInt' => [],
                    'getMoreTwentyFiveInt' => []
                ],
                'expected' => 0,
            ],

        ];
    }
}
