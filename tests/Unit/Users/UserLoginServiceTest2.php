<?php

namespace Unit\Users;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Services\User\UserIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;
use Unit\Users\DataProviders\provideDataForUser;
use App\Http\Services\User\UserLoginService;


class UserLoginServiceTest2 extends TestCase
{
    protected UserLoginService $service;
    protected UsersRepository $repository;
    protected UserIterator $iterator;

    public static function provideDataForUser(): array
    {
        return [
//            [
//                [
//                    'email' => 'mail@mail.com',
//                    'password' => '123456789',
//                ],
//                false
//            ],
            [
                [
                    'email' => 'mail@mail.com',
                    'password' => '123456789',
                ],
              UserIterator::class
            ],
        ];
    }


    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repository = $this->createMock(UsersRepository::class);
        $this->service = new UserLoginService($this->repository);

    }

    /**
     * @dataProvider provideDataForUser
     */
    public function testUserLoginService(array $data, $result): void
    {
        $res = $this->service->login($data);
        var_dump($res);
    }
}