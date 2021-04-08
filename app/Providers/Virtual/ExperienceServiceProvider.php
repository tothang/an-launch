<?php

namespace App\Providers\Virtual;

use App\EnvX\Contracts\HandlesAuth;

class ExperienceServiceProvider extends BaseServiceProvider
{
    public const LOGIN_REDIRECT = 'landing';

    protected $modules = [
        'registration',
        'agenda',
        'notifications',
        'experience',
    ];

    public function register(): void
    {
        parent::register();

        $this->loginRedirect(self::LOGIN_REDIRECT);

        $this->app->instance(HandlesAuth::class, app(HandlesAuth::PASSWORD_HANDLER));
    }
}
