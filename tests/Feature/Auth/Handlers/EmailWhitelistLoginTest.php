<?php

namespace Tests\Feature\Auth\Handlers;

use App\EnvX\Auth\Handlers\EmailWhitelist;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailWhitelistLoginTest extends TestCase
{
    use RefreshDatabase, HandlesAuthSetup;

    private const HANDLER = EmailWhitelist::class;
    private const HANDLER_KEY = 'email-whitelist';

    /** @test */
    public function can_login(): void
    {
        $user = factory(User::class)->create([
            'email' => 'user@example.com',
            'brand' => 'Hyster',
            'status' => 'password_created',
        ]);

        $this->post(route('login'), [
            'email' => $user->email
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function can_login_when_model_not_found_and_creation_allowed_and_email_in_whitelist(): void
    {
        config()->set('envx.auth-handler.creates', true);
        config()->set('envx.auth-handler.whitelist', ['@example']);

        $this->post(route('login'), [
            'email' => 'user@example.com'
        ]);

        self::assertEquals(1, User::count());
        $this->assertAuthenticatedAs(User::first());
    }

    /** @test */
    public function error_shown_when_model_not_found_and_email_in_whitelist_but_creation_not_allowed(): void
    {
        config()->set('envx.auth-handler.whitelist', ['@example']);
        config()->set('envx.auth-handler.creates', false);

        self::assertEquals(0, User::count());

        $this->post(route('login'), [
            'email' => 'user@doesnexist.com'
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();
        self::assertEquals(0, User::count());
    }

    /** @test */
    public function error_shown_when_model_not_found_and_creation_is_allowed_but_email_not_in_whitelist(): void
    {
        config()->set('envx.auth-handler.whitelist', ['@example']);
        config()->set('envx.auth-handler.creates', true);

        self::assertEquals(0, User::count());

        $this->post(route('login'), [
            'email' => 'user@notinwhitelist.com'
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();
        self::assertEquals(0, User::count());
    }
}
