<?php

namespace App\Modules\Registration\Http\Middleware;

use Closure;

class RedirectIfNotRegistered
{
    public function handle($request, Closure $next, ?string $route = 'registration.index')
    {
        if (auth()->user()->isRegistered() === false) {
            return redirect()->route($route);
        }

        return $next($request);
    }
}
