<?php

namespace App\Modules\Registration\Http\Middleware;

use Closure;

class RedirectIfRegistered
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isRegistered()) {
            return redirect()->route('holding');
        }

        return $next($request);
    }
}
