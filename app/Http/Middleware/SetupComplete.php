<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SetupComplete
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() === null) {
            return $this->redirectTo();
        }

        if ($request->user()->setup_complete) {
            return $this->redirectTo();
        }

        return $next($request);
    }

    private function redirectTo(): RedirectResponse
    {
        return redirect()->route(is_admin() ? 'admin.dashboard' : 'index');
    }
}
