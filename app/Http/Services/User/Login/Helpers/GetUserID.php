<?php

namespace App\Http\Services\User\Login\Helpers;

class GetUserID
{

    public function getUserId(): int
    {
        return auth()->user()->id;
    }
}

