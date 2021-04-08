<?php

namespace App\Providers\Virtual;

class BroadcastServiceProvider extends BaseServiceProvider
{
    public const LOGIN_REDIRECT = 'webinar';

    public function register(): void
    {
        parent::register();

        $this->loginRedirect(self::LOGIN_REDIRECT);
    }
}
