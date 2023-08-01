<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Repositories\User\UsersRepository;
use App\Http\Services\User\Login\Helpers\GetUserID;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class SetAuthUserServiceHandle implements LoginInterface
{

    public function __construct(
        protected UsersRepository $usersRepository,
        protected GetUserID $getUserID
    )
    {
    }
    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $userId = $this->usersRepository->getById(
            $this->getUserID->getUserId()
        );
        $loginDTO->setUserId($userId);
        return $next($loginDTO);
    }
}
