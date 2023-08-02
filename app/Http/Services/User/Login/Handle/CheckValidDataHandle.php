<?php

namespace App\Http\Services\User\Login\Handle;

use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginInterface;
use App\Http\Services\User\Login\Helpers\CheckAuthData;
use Closure;
use Tests\Unit\Users\DataProviders\provideDataForUser;


class CheckValidDataHandle implements LoginInterface
{

    public function __construct(
        protected CheckAuthData $checkAuthData
    )
    {
    }
    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $data = [
            'email' => $loginDTO->getEmail(),
            'password' => $loginDTO->getPassword(),
        ];
        if($this->checkAuthData->getAuth($data) === false){
            $loginDTO->setResult(false);
            return $loginDTO;
        }
        $loginDTO->setResult(true);
        return $next($loginDTO);
    }



}
