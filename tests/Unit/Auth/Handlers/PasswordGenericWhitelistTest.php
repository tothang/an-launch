<?php

namespace Tests\Unit\Auth\Handlers;

use App\EnvX\Auth\Handlers\Handler;
use App\EnvX\Auth\Handlers\PasswordGenericWhitelist;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordGenericWhitelistTest extends TestCase
{
    use RefreshDatabase, HandlesAuthContractTests;

    public function authHandler(): Handler
    {
        return app(PasswordGenericWhitelist::class);
    }

    /** @test */
    public function requires_password_for_login(): void
    {
        self::assertTrue($this->authHandler()->requiresPassword());
    }

    /** @test */
    public function can_create_if_correct_generic_password_submitted_and_email_domain_whitelisted(): void
    {
        $handler = $this->authHandler();

        $user = factory(User::class)->create([
            'email' => 'user@testing.com',
        ]);

        $passPassword = 'PASS';
        $failPassword = 'FAIL';

        config()->set('envx.generic-password', $passPassword);
        request()->merge(['email' => $user->email]);

        self::assertFalse($this->shouldCreateConsideringPassword($handler, $failPassword));
        self::assertFalse($this->shouldCreateConsideringPassword($handler, $passPassword));

        config()->set('envx.auth-handler.whitelist', ['@testing']);

        self::assertTrue($this->shouldCreateConsideringPassword($handler, $passPassword));
    }

    /** @test */
    public function actions_user_login_if_correct_generic_password_submitted_and_user_exists(): void
    {
        $handler = $this->authHandler();
        $user = factory(User::class)->create();

        $passPassword = 'PASS';
        $failPassword = 'FAIL';

        config()->set('envx.generic-password', $passPassword);
        config()->set('envx.auth-handler.whitelist', [
            '@example'
        ]);

        $this->attemptLoginWithPassword($handler, $failPassword, $user);
        $this->assertGuest();

        $this->attemptLoginWithPassword($handler, $passPassword, $user);
        $this->assertAuthenticatedAs($user);
    }
}
