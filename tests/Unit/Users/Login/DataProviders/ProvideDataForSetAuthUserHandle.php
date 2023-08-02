<?php

namespace Tests\Unit\Users\Login\DataProviders;

class ProvideDataForSetAuthUserHandle
{

    public static function LoginServiceTest(): array
    {
        return [
            [
                ['email' => 'mail@mail.com', 'password' => '123456789'],
                'result' => 2,
                'expected' => 2,
            ],
        ];
    }
}
