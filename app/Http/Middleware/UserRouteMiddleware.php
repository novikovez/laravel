<?php

namespace App\Http\Middleware;

use App\Http\Controllers\User\SetUserRouteController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRouteMiddleware
{

    public function __construct(
        protected SetUserRouteController $setUserRouteController
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->setUserRouteController->setUserRoute($request);
        return $next($request);
    }
}
