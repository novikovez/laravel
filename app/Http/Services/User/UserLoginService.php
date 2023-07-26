<?php

namespace App\Http\Services\User;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Resources\User\UserResource;

class UserLoginService
{

    public function __construct(
        protected UsersRepository $repository
    )
    {
    }
    public function login($data): false|UserIterator
    {

        if(auth()->attempt($data) === false) {
            return false;
        }

        return $this->getById(
            auth()->user()->id
        );
    }

    private function getById($id): UserIterator
    {
        return $this->repository->getById($id);
    }

    public function getToken()
    {
        return auth()
            ->user()
            ->createToken(config('app.name'));
    }
}
