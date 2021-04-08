<?php

namespace Tests\Unit\Auth\Handlers;

use App\EnvX\Auth\Handlers\Handler;
use App\EnvX\Auth\Handlers\PasswordGeneric;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordGenericTest extends TestCase
{
    use RefreshDatabase, HandlesAuthContractTests;

    public function authHandler(): Handler
    {
        return app(PasswordGeneric::class);
    }

    /** @test */
    public function requires_password_for_login(): void
    {
        self::assertTrue($this->authHandler()->requiresPassword());
    }

    /** @test */
    public function can_create_if_correct_generic_password_submitted(): void
    {
        $handler = $this->authHandler();

        $passPassword = 'PASS';
        $failPassword = 'FAIL';

        config()->set('envx.generic-password', $passPassword);

        $handler->setRequest(request()->merge(['password' => $failPassword]));
        self::assertFalse($handler->shouldCreate());

        $handler->setRequest(request()->merge(['password' => $passPassword]));
        self::assertTrue($handler->shouldCreate());
    }

    /** @test */
    public function actions_user_login_if_correct_generic_password_submitted(): void
    {
        $handler = $this->authHandler();
        $user = factory(User::class)->create();

        $passPassword = 'PASS';
        $failPassword = 'FAIL';

        config()->set('envx.generic-password', $passPassword);

        $this->attemptLoginWithPassword($handler, $failPassword, $user);
        $this->assertGuest();

        $this->attemptLoginWithPassword($handler, $passPassword, $user);
        $this->assertAuthenticatedAs($user);
    }
}
