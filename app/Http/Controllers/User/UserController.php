<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\UserServices;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function __construct(
        protected UserServices $services
    )
    {
    }

    public function login(UserLoginRequest $request): Application|Response|UserResource
    {

        $data = $request->validated();
        return $this->services->login($data);

    }
}
