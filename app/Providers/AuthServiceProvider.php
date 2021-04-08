<?php

namespace App\Providers;

use App\EnvX\Auth\Handlers\Email;
use App\EnvX\Auth\Handlers\EmailWhitelist;
use App\EnvX\Auth\Handlers\Password;
use App\EnvX\Auth\Handlers\PasswordGeneric;
use App\EnvX\Contracts\HandlesAuth;
use App\EnvX\Auth\Handlers\PasswordGenericWhitelist;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register(): void
    {
        $this->app->singleton(HandlesAuth::EMAIL_HANDLER, Email::class);
        $this->app->singleton(HandlesAuth::EMAIL_WHITELIST_HANDLER, EmailWhitelist::class);
        $this->app->singleton(HandlesAuth::PASSWORD_HANDLER, Password::class);
        $this->app->singleton(HandlesAuth::PASSWORD_GENERIC_HANDLER, PasswordGeneric::class);
        $this->app->singleton(HandlesAuth::PASSWORD_GENERIC_WHITELIST_HANDLER, PasswordGenericWhitelist::class);
        $this->app->tag(HandlesAuth::HANDLERS, ['auth-handlers']);

        $this->app->bind(HandlesAuth::class, static function ($app) {
            return $app->make(config('envx.auth-handler.type') . HandlesAuth::HANDLER_AFFIX);
        });

        $this->app->rebinding('request', function ($app) {
            collect($this->app->tagged('auth-handlers'))->each->setRequest($app->request);
        });
    }

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
