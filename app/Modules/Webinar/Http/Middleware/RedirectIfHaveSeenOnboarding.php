<?php


namespace App\Modules\Webinar\Http\Middleware;
use Closure;

class RedirectIfHaveSeenOnboarding
{
public function handle($request, Closure $next)
    {
        if (auth()->user()->seenOnBoarding()){
            return redirect()->route('webinar');
        }

        return $next($request);
    }
}
