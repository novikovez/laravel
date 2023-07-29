<?php

namespace App\Http\Services\User;

use App\Http\Repositories\User\UsersRepository;

class UserAuthService
{
    public function __construct(
        protected UsersRepository $repository,
    )
    {
    }

    public function login($data): bool
    {
        return auth()->attempt($data);
    }

    public function getById($id): UserIterator
    {
        return $this->repository->getById($id);
    }

    public function getUserId(): int
    {
        return auth()->user()->id;

    }

}
