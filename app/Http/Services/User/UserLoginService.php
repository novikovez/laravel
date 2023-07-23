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
    public function login($data): false|UserResource
    {

        if(auth()->attempt($data) === false) {
            return false;
        }

        $token = auth()
            ->user()
            ->createToken(config('app.name'));


        $userResource = new UserResource(
            $this->getById(
                auth()->user()->id
            )
        );

        return $userResource->additional([
            'Bearer' => $token,
        ]);

    }

    private function getById($id): UserIterator
    {
        return $this->repository->getById($id);
    }
}
