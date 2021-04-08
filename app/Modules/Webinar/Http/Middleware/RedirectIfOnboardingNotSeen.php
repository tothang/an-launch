<?php

namespace App\Modules\Webinar\Http\Middleware;

use App\Config;
use Closure;

class RedirectIfOnboardingNotSeen
{
    public function handle($request, Closure $next)
    {
        if ($this->shouldRedirectToOnboarding()) {
            return redirect()->route('onboarding.index');
        }

        return $next($request);
    }

    private function shouldRedirectToOnboarding(): bool
    {
        return Config::getBoolFromCache('onboarding') && auth()->user()->seen_onboarding === 0;
    }
}
