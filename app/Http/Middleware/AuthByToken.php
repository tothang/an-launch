<?php

namespace App\Http\Middleware;

use App\Token;
use App\Admin;
use Closure;
use Illuminate\Http\Request;

class AuthByToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('token') === false) {
            return $next($request);
        }

        $tokenBearer = optional(Token::fetch($request->token))->tokenable;

        if ($tokenBearer === null) {
            session()->put('token-expired', 'This login link has expired, please contact the events team.');

            return redirect('/');
        }

        if ($tokenBearer instanceof Admin) {
            auth('admin')->login($tokenBearer);

            return redirect()->route('admin.dashboard');
        }

        auth()->login($tokenBearer);

        return redirect('/');
    }
}
