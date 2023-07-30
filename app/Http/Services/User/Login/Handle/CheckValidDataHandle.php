<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use Closure;

class CheckValidDataHandle implements LoginInterface
{

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $data = [
            'email' => $loginDTO->getEmail(),
            'password' => $loginDTO->getPassword(),
        ];
        if(auth()->attempt($data) === false)
        {
            return $loginDTO;
        }
        return $next($loginDTO);
    }
}
