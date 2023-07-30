<?php

namespace App\Http\Services\User\Login;

use App\Http\Services\User\Login\Handle\CheckValidDataHandle;
use App\Http\Services\User\Login\Handle\CheckWhiteListIpHandle;
use App\Http\Services\User\Login\Handle\SetAuthUserServiceHandle;
use App\Http\Services\User\Login\Handle\SetLastActivityUserHandle;
use App\Http\Services\User\Login\Handle\SetPersonalTokenHandle;
use App\Http\Services\User\UserIterator;
use Illuminate\Pipeline\Pipeline;

class LoginService
{

    protected const HANDLERS = [
        CheckValidDataHandle::class,
        SetAuthUserServiceHandle::class,
        CheckWhiteListIpHandle::class,
        SetLastActivityUserHandle::class,
        SetPersonalTokenHandle::class
    ];

    public function __construct(
        protected Pipeline $pipeline,
    )
    {
    }

    public function handle(LoginDTO $loginDTO): mixed
    {
        return $this->pipeline
            ->send($loginDTO)
            ->through(self::HANDLERS)
            ->then(function (LoginDTO $loginDTO){
                    return $loginDTO;
            });

    }
}
