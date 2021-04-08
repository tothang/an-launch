<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Setup
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->setup_complete === false) {
            return redirect()->route('create-password.show');
        }

        return $next($request);
    }
}
