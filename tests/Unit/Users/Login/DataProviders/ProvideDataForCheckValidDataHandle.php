<?php

namespace Tests\Unit\Users\Login\DataProviders;

class ProvideDataForCheckValidDataHandle
{

    public static function LoginServiceTest(): array
    {
        return [
            [
                ['email' => 'mail@mai1l.com', 'password' => '1234561789'],
                'result' => false,
                'expected' => false,
            ],
            [
                ['email' => 'mail@mail.com', 'password' => '123456789'],
                'result' => true,
                'expected' => true,
            ],
        ];
    }
}
