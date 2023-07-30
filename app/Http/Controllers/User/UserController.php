<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\Login\LoginService;
use App\Http\Services\User\UserIterator;
use Illuminate\Http\Response;
use ReflectionClass;
use ReflectionException;

class UserController extends Controller
{

    public function __construct(
        protected LoginService $loginService
    )
    {
    }

    /**
     */
    public function login(UserLoginRequest $request): Response|UserResource
    {
        $data = $request->validated();
        $loginDTO = new LoginDTO(...$data);
        $this->loginService->handle($loginDTO);
        if (is_null($loginDTO->getUserId())) {
            return $this->getBadAuthResponse();
        }

        $resource = new UserResource($loginDTO);

        return $resource->additional([
            'Bearer' => $loginDTO->getToken(),
        ]);
    }
}
