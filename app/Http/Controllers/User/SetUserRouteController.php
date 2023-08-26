<?php

namespace App\Http\Controllers\User;

use App\Enum\UserMethodEnum;
use App\Http\Controllers\User\DTO\UserRouteDTO;
use App\Http\Services\User\SetUserRouteService;
use Illuminate\Http\Request;

class SetUserRouteController
{
    public function __construct(
        protected SetUserRouteService $setUserRouteService
    )
    {
    }

    public function setUserRoute(Request $request): void
    {
        $dto = new UserRouteDTO(
            $request->user()->id,
            $request->route()->uri,
            UserMethodEnum::tryFrom($request->method())
        );
        $this->setUserRouteService->setUserRoute($dto);
    }
}
