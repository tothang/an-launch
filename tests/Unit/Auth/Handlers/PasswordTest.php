<?php

namespace Tests\Unit\Auth\Handlers;

use App\EnvX\Auth\Handlers\Handler;
use App\EnvX\Auth\Handlers\Password;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordTest extends TestCase
{
    use RefreshDatabase, HandlesAuthContractTests;

    public function authHandler(): Handler
    {
        return app(Password::class);
    }

    /** @test */
    public function requires_password_for_login(): void
    {
        self::assertTrue($this->authHandler()->requiresPassword());
    }

    /** @test */
    public function never_creates(): void
    {
        self::assertFalse($this->authHandler()->shouldCreate());
    }

    /** @test */
    public function actions_user_login_when_password_is_correct(): void
    {
        $handler = $this->authHandler();

        $passPassword = 'PASS';
        $failPassword = 'FAIL';

        $user = factory(User::class)->create([
            'password' => bcrypt($passPassword),
        ]);

        $this->attemptLoginWithPassword($handler, $failPassword, $user);
        $this->assertGuest();

        $this->attemptLoginWithPassword($handler, $passPassword, $user);
        $this->assertAuthenticatedAs($user);
    }
}
