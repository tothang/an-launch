<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if ($request->expectsJson()) {
            return $next($request);
        }

        if (
            config('envx.block-concurrent-logins')
            && auth()->user()->session_id !== session()->getId()
        ) {
            session()->flush();
            return redirect(route('login'));
        }

        return $next($request);
    }
}
