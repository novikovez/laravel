<?php

namespace Tests\Unit\Users\Login\DataProviders;

class ProvideDataForSetLastActivity
{

    public static function LoginServiceTest(): array
    {
        return [
            [
                'id' => 0,
                'result' => false,
                'expected' => false,
            ],
            [
                'id' => 2,
                'result' => true,
                'expected' => true,
            ],
        ];
    }
}
