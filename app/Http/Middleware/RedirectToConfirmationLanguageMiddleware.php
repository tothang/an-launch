<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToConfirmationLanguageMiddleware
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

        if (is_null($user) || $user->is_confirmed_language) {
            return $next($request);
        }

        return redirect()->route('confirmation-language');
    }
}
