<?php

namespace Tests\Feature\Auth\Handlers;

use App\EnvX\Auth\Handlers\PasswordGeneric;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordGenericLoginTest extends TestCase
{
    use RefreshDatabase, HandlesAuthSetup;

    private const HANDLER = PasswordGeneric::class;
    private const HANDLER_KEY = 'password-generic';

    /** @test */
    public function can_login(): void
    {
        $user = factory(User::class)->create([
            'email' => 'user@example.com',
            'brand' => 'Hyster',
            'status' => 'password_created',
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => $this->initGenericPassword(),
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function can_login_when_model_not_found_and_password_correct_and_creation_allowed(): void
    {
        config()->set('envx.auth-handler.creates', true);

        self::assertEquals(0, User::count());

        $this->post(route('login'), [
            'email' => 'user@example.com',
            'password' => $this->initGenericPassword(),
        ]);

        self::assertEquals(1, User::count());
        $this->assertAuthenticatedAs(User::first());
    }

    /** @test */
    public function error_shown_when_password_incorrect(): void
    {
        $this->initGenericPassword();

        $this->post(route('login'), [
            'email' => 'user@example.com',
            'password' => 'FAIL',
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function error_shown_when_model_not_found_and_password_correct_and_creation_not_allowed(): void
    {
        config()->set('envx.auth-handler.creates', false);

        $this->post(route('login'), [
            'email' => 'user@example.com',
            'password' => $this->initGenericPassword(),
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();
    }
}
