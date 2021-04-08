<?php

namespace Tests\Unit\Auth\Handlers;

use App\EnvX\Auth\Handlers\EmailWhitelist;
use App\EnvX\Auth\Handlers\Handler;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailWhitelistTest extends TestCase
{
    use RefreshDatabase, HandlesAuthContractTests;

    public function authHandler(): Handler
    {
        return app(EmailWhitelist::class);
    }

    /** @test */
    public function does_not_require_password_for_login(): void
    {
        self::assertFalse($this->authHandler()->requiresPassword());
    }

    /** @test */
    public function can_create_if_configuration_allows_and_email_domain_is_whitelisted(): void
    {
        $handler = $this->authHandler()->setRequest(
            request()->merge(['email' => 'test@testing.com'])
        );

        self::assertFalse($handler->shouldCreate());

        config()->set('envx.auth-handler.whitelist', ['@testing']);

        self::assertTrue($handler->shouldCreate());
    }

    /** @test */
    public function actions_user_login(): void
    {
        $user = factory(User::class)->create();

        $this->assertGuest();

        $this->authHandler()->attemptLogin($user);

        $this->assertAuthenticatedAs($user);
    }
}
