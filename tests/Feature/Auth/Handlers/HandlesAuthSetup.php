<?php

namespace Tests\Feature\Auth\Handlers;

use App\EnvX\Contracts\HandlesAuth;
use App\Providers\AuthServiceProvider;

trait HandlesAuthSetup
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('envx.auth-handler.type', self::HANDLER_KEY);

        $this->app->register(AuthServiceProvider::class, true);
    }

    public function initGenericPassword(): string
    {
        $password = 'GenericPassword';

        config()->set('envx.generic-password', $password);

        return $password;
    }

    /** @test */
    public function handler_set_correctly(): void
    {
        self::assertInstanceOf(self::HANDLER, app(HandlesAuth::class));
    }
}
