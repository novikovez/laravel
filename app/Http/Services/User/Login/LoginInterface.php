<?php

namespace App\Http\Services\User\Login;

use Closure;

interface LoginInterface
{
    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO;
}
