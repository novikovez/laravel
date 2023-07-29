<?php

namespace Unit\Users;

use App\Http\Services\User\UserAuthService;
use App\Http\Services\User\UserIterator;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Unit\Users\DataProviders\provideDataForUser;
use App\Http\Services\User\UserLoginService;


class UserLoginServiceTest extends TestCase
{
    protected UserLoginService $service;
    protected MockObject $userAuthService;
    protected MockObject $userIterator;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userAuthService = $this->createMock(UserAuthService::class);
        $this->userIterator = $this->createMock(UserIterator::class);
        $this->service = new UserLoginService($this->userAuthService);

    }

    /**
     * @dataProvider Tests\Unit\Users\DataProviders\provideDataForUser::UserLoginServiceTest()
     */
    public function testUserLoginService(array $data, bool $result, bool $expected): void
    {
        $this->userAuthService
            ->method('login')
            ->willReturn($result);

        $this->userAuthService
            ->method('getUserId')
            ->willReturn(1);

        $this->userAuthService
            ->method('getById')
            ->willReturn($this->userIterator);

        $result = $this->service->login($data);
        $this->assertSame($expected, $result instanceof UserIterator);

    }
}
