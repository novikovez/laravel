<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Services\User\Login\Helpers\GetToken;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class SetPersonalTokenHandle implements LoginInterface
{
    public function __construct(
        protected GetToken $getToken
    )
    {
    }

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $loginDTO->setToken(
           $this->getToken->getToken()
        );
        return $next($loginDTO);
    }
}
