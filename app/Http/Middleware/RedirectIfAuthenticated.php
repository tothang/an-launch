<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    private $auth;

    public function __construct(Factory $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next, ...$guards)
    {
        $this->authenticate($guards);

        if (auth()->check()) {
            return redirect()->route(is_admin() ? 'admin.dashboard' : app('login.redirect'));
        }

        return $next($request);
    }

    private function authenticate(array $guards = []): void
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);
            }
        }
    }
}
