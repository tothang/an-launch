<?php

namespace App\Http;

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\Setup;
use App\Http\Middleware\SetupComplete;
use App\Modules\Registration\Http\Middleware\RedirectIfNotRegistered;
use App\Modules\Registration\Http\Middleware\RedirectIfRegistered;
use App\Modules\SupportChat\Http\Middleware\RedirectIfSupportChatDoesExist;
use App\Modules\Webinar\Http\Middleware\RedirectIfOnboardingNotSeen;
use App\Modules\Webinar\Http\Middleware\RedirectIfHaveSeenOnboarding;
use App\Modules\Webinar\Http\Middleware\RedirectIfStreamLive;
use App\Modules\Webinar\Http\Middleware\RedirectIfStreamNotLive;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            SetLocale::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'tokenAuth' => \App\Http\Middleware\AuthByToken::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'setup' => Setup::class,
        'setupComplete' => SetupComplete::class,
        'onboarding' => RedirectIfOnboardingNotSeen::class,
        'seen_onboard' => RedirectIfHaveSeenOnboarding::class,
        'streamNotLive' => RedirectIfStreamNotLive::class,
        'streamLive' => RedirectIfStreamLive::class,
        'registered' => RedirectIfRegistered::class,
        'notRegistered' => RedirectIfNotRegistered::class,
        'hasSupportChat' => RedirectIfSupportChatDoesExist::class,
        'verified_user_by_token' => \App\Modules\Webinar\Http\Middleware\VerifiedUserByTokenMiddleware::class,
        'check_registered' => \App\Http\Middleware\CheckUserRegisteredMiddleware::class,
        'check_confirmation_language' => \App\Http\Middleware\RedirectToConfirmationLanguageMiddleware::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
        \App\Http\Middleware\RedirectToConfirmationLanguageMiddleware::class,
    ];
}
