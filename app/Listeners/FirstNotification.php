<?php

namespace App\Listeners;

use App\Events\FirstEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class FirstNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FirstEvent $event): void
    {
        $oneRoute = $event->userRouteDTO->getUserId() . $event->userRouteDTO->getRoute();
        $allRoute = $event->userRouteDTO->getUserId();

        if(Redis::get($oneRoute) === null)
        {
            Redis::set($oneRoute, 0, 'EX', 60);
            Redis::set($allRoute, 0, 'EX', 60);
        }

        $count = Redis::incr($oneRoute);
        $allCount = Redis::incr($allRoute);

        if($count > 10 AND $count < 30)
        {
            Log::info('single route');
        }

        if($allCount > 30)
        {
            Log::info('multiple route');
        }
    }
}
