<?php

namespace Tests\Unit\Users\Login\DataProviders;

use function PHPUnit\Framework\assertTrue;

class ProvideDataForWhiteListHandle
{

    public static function LoginServiceTest(): array
    {
        return [
            [
                ['email' => 'mail@mai1l.com', 'password' => '1234561789', 'id' => 0],
                'result' => false,
                'expected' => false,
            ],
            [
                ['email' => 'mail@mail.com', 'password' => '123456789', 'id' => 2],
                'result' => true,
                'expected' => true,
            ],
        ];
    }
}
