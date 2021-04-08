<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRegisteredMiddleware
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
        /** @var \App\User|null */
        $user = $request->user();

        // user not register, redirect to register page
        if (is_null($user) || $user->isRegistered()) {
            return $next($request);
        }

        if ($user->isDeclined()) {
            return redirect()->route('welcome');
        }

        return redirect()->route('registration.index');
    }
}
