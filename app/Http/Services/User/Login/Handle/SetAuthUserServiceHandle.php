<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class SetAuthUserServiceHandle implements LoginInterface
{

    public function __construct(
        protected UsersRepository $usersRepository
    )
    {
    }
    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $userId = $this->usersRepository->getById(
            auth()->user()->id
        );
        $loginDTO->setUserId($userId);

        return $next($loginDTO);
    }
}
