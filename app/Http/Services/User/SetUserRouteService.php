<?php

namespace App\Http\Services\User;

use App\Http\Controllers\User\DTO\UserRouteDTO;
use App\Http\Repositories\User\SetUserRouteRepository;

class SetUserRouteService
{
    public function __construct(
        protected SetUserRouteRepository $setUserRouteRepository
    )
    {
    }

    public function setUserRoute(UserRouteDTO $userRouteDTO):void
    {
        $this->setUserRouteRepository->setUserRoute($userRouteDTO);
    }
}
