<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class SetPersonalTokenHandle implements LoginInterface
{

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $loginDTO->setToken(
            auth()
                ->user()->createToken('APP')
        );
        return $next($loginDTO);
    }
}
