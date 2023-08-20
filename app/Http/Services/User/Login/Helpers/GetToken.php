<?php

namespace App\Http\Services\User\Login\Helpers;

use Laravel\Passport\PersonalAccessTokenResult;

class GetToken
{

    public function getToken(): PersonalAccessTokenResult
    {
        return auth()->user()->createToken('secret');
    }
}


