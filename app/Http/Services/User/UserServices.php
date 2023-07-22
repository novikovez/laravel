<?php

namespace App\Http\Services\User;

use App\Http\Resources\User\UserResource;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;


class UserServices
{
    public function login($data): Application|Response|UserResource
    {

        if(auth()->attempt($data) === false) {
            return response('Bad Auth Data!', 422);
        }

        $token = auth()
            ->user()
            ->createToken(config('app.name'));

        $data['token'] = $token;
        return new UserResource(new UserIterator(collect($data)));
    }
}
