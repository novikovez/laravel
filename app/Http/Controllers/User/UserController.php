<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\UserLoginService;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function login(UserLoginRequest $request, UserLoginService $service): Response|UserResource
    {

        $data = $request->validated();
        $result = $service->login($data);
        if($result === false) {
            return $this->getBadAuthResponse();
        }
        $resource = new UserResource($result);
        $resource->additional(['Bearer' => $service->getToken()]);
        return $resource;
    }
}
