<?php
namespace Unit\DZ11;

class provideDataForDService
{
    public function __invoke(): array
    {
        return [
            [
                [10,5,7,9,55,11,20,21,25,35,40],
                'expected' => 2,
            ],
            [
                [10,16,12],
                'expected' => 0,
            ],
            [
                [],
                'expected' => 0,
            ],

        ];
    }
}

