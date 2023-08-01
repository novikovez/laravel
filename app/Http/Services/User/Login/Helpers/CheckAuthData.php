<?php

namespace App\Http\Services\User\Login\Helpers;

class CheckAuthData
{

    public function getAuth($data): bool
    {
        if(auth()->attempt($data) === false)
        {
            return false;
        }

        return true;
    }
}
