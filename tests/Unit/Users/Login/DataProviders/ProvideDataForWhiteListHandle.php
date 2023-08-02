<?php

namespace Tests\Unit\Users\Login\DataProviders;

use function PHPUnit\Framework\assertTrue;

class ProvideDataForWhiteListHandle
{

    public static function LoginServiceTest(): array
    {
        return [
            [
                'id' => 2,
                'result' => true,
                'expected' => true,
            ],
        ];
    }
}
