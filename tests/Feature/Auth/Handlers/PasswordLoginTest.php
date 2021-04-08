<?php

namespace Tests\Feature\Auth\Handlers;

use App\EnvX\Auth\Handlers\Password;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordLoginTest extends TestCase
{
    use RefreshDatabase, HandlesAuthSetup;

    private const HANDLER = Password::class;
    private const HANDLER_KEY = 'password';

    /** @test */
    public function can_login(): void
    {
        $user = factory(User::class)->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'brand' => 'Hyster',
            'status' => 'password_created'
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function error_shown_when_model_not_found(): void
    {
        $this->post(route('login'), [
            'email' => 'user@doesntexist.com',
            'password' => 'password',
            'brand' => 'Hyster',
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function error_shown_when_password_incorrect(): void
    {
        $user = factory(User::class)->create([
            'email' => 'user@example.com',
            'password' => bcrypt('PASS'),
            'brand' => 'Hyster',
            'status' => 'password_created'
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'FAIL',
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();
    }
}
