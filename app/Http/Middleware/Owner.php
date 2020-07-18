<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $this->authorizedUser()) {
            throw new AuthorizationException();
            // abort(Response::HTTP_FORBIDDEN);
            // throw new AuthorizationException('No papu.');
        }

        return $next($request);
    }

    protected function authorizedUser()
    {
        return optional(auth()->user())->is_owner;
        // return (auth()->check() && auth()->user()->is_owner);
    }
}
