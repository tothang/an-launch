<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SetLocale
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
        App::setLocale('en');

        if (Auth::check()) {
            $cookieUserLanguage = $request->cookie('user_language') ?? 'English';
            $userLanguage = Auth::user()->language ?? 'English';
            if ($cookieUserLanguage !== $userLanguage) {
                Cookie::queue('user_language', $userLanguage);
            }
        } else {
            $userLanguage = $request->cookie('user_language') ?? 'English';
        }

        App::setLocale(User::LOCALE_MAPPING[$userLanguage]);

        return $next($request);
    }
}
