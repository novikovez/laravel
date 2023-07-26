<?php

namespace Unit\Users\DataProviders;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Services\User\UserLoginService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class provideDataForUser extends TestCase
{

    public function UserLoginServiceTest(): array
    {
        return [
            [
                'email' => 'mail@mail.com',
                'password' => '1234567891',
            ],
            false,
        ];
    }
}
