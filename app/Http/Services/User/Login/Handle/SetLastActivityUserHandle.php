<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Repositories\User\WhiteListIp\SetActivityRepository;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class SetLastActivityUserHandle implements LoginInterface
{

    public function __construct(
        protected SetActivityRepository $setActivityRepository
    )
    {
    }
    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        if($this->setActivityRepository->setUserActivity(
            $loginDTO->getUserId(),
            request()->ip()
        ) === false) {
            $loginDTO->setResult(false);
            return $loginDTO;
        }
        $loginDTO->setResult(true);
        return $next($loginDTO);
    }
}
