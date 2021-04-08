<?php

namespace App\Modules\Webinar\Http\Middleware;

use App\Token;
use Closure;

class VerifiedUserByTokenMiddleware
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
        if (! $request->has('token')) {
            return redirect('/');
        }

        $token = Token::fetch($request->token);

        if (! $token) {
            return redirect('/');
        }

        /** @var \App\User */
        $user = $token->tokenable;

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
