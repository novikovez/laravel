<?php

namespace App\Http\Services\User;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\UserAuthService;

class UserLoginService
{

    public function __construct(
        protected UserAuthService $userAuthService,
    )
    {
    }

    public function login($data): false|UserIterator
    {

        if($this->userAuthService->login($data) === false) {
            return false;
        }
        $userId = $this->userAuthService->getUserId();
        return $this->userAuthService->getById($userId);

    }

    public function getToken()
    {
        return auth()
            ->user()
            ->createToken(config('app.name'));
    }
}
