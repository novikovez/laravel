<?php

namespace Unit\Users\Login;

use App\Http\Services\User\Login\Handle\SetAuthUserServiceHandle;
use App\Http\Services\User\Login\Helpers\GetUserID;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\UserIterator;
use Exception;
use App\Http\Repositories\User\UsersRepository;
use Tests\TestCase;

class SetAuthUserServiceHandleTest extends TestCase
{
    protected SetAuthUserServiceHandle $setAuthUserServiceHandle;
    protected UsersRepository $userRepository;
    protected UserIterator $userIterator;
    protected GetUserID $getUserID;

    protected LoginDTO $loginDTO;

    /**
     * @throws Exception
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->userRepository = $this->createMock(UsersRepository::class);
        $this->userIterator = $this->createMock(UserIterator::class);
        $this->getUserID = $this->createMock(GetUserID::class);
        $this->loginDTO = $this->createMock(LoginDTO::class);
        $this->setAuthUserServiceHandle = new SetAuthUserServiceHandle($this->userRepository, $this->getUserID );

    }
    /**
     * @dataProvider Tests\Unit\Users\Login\DataProviders\ProvideDataForSetAuthUserHandle::LoginServiceTest()
     */
    public function testLoginService(array $data, int $result, int $expected): void
    {
        $loginDTO = new LoginDTO($data['email'], $data['password']);

        $this->getUserID
            ->method('getUserId')
            ->willReturn($result);

        $this->userRepository
            ->method('getById')
            ->willReturn($this->userIterator);

        $this->userIterator
            ->method('getId')
            ->willReturn($result);

        $this->loginDTO
            ->method('setUserId')
            ->with($result);

        $this->loginDTO
            ->method('getUserId')
            ->willReturn($result);

        $this->setAuthUserServiceHandle->handle($this->loginDTO, function (LoginDTO $loginDTO){
            return $loginDTO;
        });
        $this->assertSame($expected, $this->loginDTO->getUserId());
    }
}
