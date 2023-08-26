<?php

namespace App\Http\Repositories\User;

use App\Events\FirstEvent;
use App\Http\Controllers\User\DTO\UserRouteDTO;
use Illuminate\Support\Facades\DB;

class SetUserRouteRepository
{
    public function setUserRoute(UserRouteDTO $userRouteDTO):void
    {
        DB::table('user_route_action')
            ->insert([
                "user_id" => $userRouteDTO->getUserId(),
                "method" => $userRouteDTO->getUserRouteEnum()->value,
                "route" => $userRouteDTO->getRoute(),
                "created_at" => now()
            ]);

        FirstEvent::dispatch($userRouteDTO);
    }
}
