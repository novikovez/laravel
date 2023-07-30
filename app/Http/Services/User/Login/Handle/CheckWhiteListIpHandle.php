<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Repositories\User\WhiteListIp\WhiteListIpRepository;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class CheckWhiteListIpHandle implements LoginInterface
{
    public function __construct(
        protected WhiteListIpRepository $whiteListIpRepository,
    )
    {
    }

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $result = $this->whiteListIpRepository->checkUserIp(
            $loginDTO->getUserId()->getId(),
            request()->ip()
        );
        if($result === false) {
            return $loginDTO;
        }
        return $next($loginDTO);
    }
}
