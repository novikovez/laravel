<?php

namespace Unit\Users;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Services\User\UserAuthService;
use App\Http\Services\User\UserIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
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



    public static function provideDataForUser(): array
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
     * @dataProvider provideDataForUser
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
