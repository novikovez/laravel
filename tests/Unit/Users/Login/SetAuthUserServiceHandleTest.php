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
        $this->setAuthUserServiceHandle = new SetAuthUserServiceHandle($this->userRepository, $this->getUserID );

    }
    /**
     * @dataProvider Tests\Unit\Users\Login\DataProviders\ProvideDataForCheckValidDataHandle::LoginServiceTest()
     */
    public function testLoginService(array $data, bool $result, bool $expected): void
    {
        $loginDTO = new LoginDTO($data['email'], $data['password']);

        $this->getUserID
            ->method('getUserId')
            ->willReturn(2);

        $this->userRepository
            ->method('getById')
            ->with($this->getUserID)
            ->willReturn($this->userIterator);


        $data = $this->setAuthUserServiceHandle->handle($loginDTO, function (LoginDTO $loginDTO){
            return $loginDTO;
        });
        $this->assertSame($expected, $data->getUserId()->getId());
    }
}
