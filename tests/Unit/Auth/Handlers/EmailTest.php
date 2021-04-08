<?php

namespace Tests\Unit\Auth\Handlers;

use App\EnvX\Auth\Handlers\Email;
use App\EnvX\Auth\Handlers\Handler;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase, HandlesAuthContractTests;

    public function authHandler(): Handler
    {
        return app(Email::class);
    }

    /** @test */
    public function does_not_require_password_for_login(): void
    {
        self::assertFalse($this->authHandler()->requiresPassword());
    }

    /** @test */
    public function can_create_if_configuration_allows(): void
    {
        self::assertTrue($this->authHandler()->shouldCreate());
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
