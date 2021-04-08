<?php

namespace Tests\Feature\Auth\Handlers;

use App\EnvX\Auth\Handlers\Email;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailLoginTest extends TestCase
{
    use RefreshDatabase, HandlesAuthSetup;

    private const HANDLER = Email::class;
    private const HANDLER_KEY = 'email';

    /** @test */
    public function can_login(): void
    {
        config()->set('envx.auth-handler.creates', false);

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
    public function can_login_when_model_not_found_and_creation_allowed(): void
    {
        config()->set('envx.auth-handler.creates', true);

        $this->post(route('login'), [
            'email' => 'user@doesntexist.com',
        ]);

        self::assertEquals(1, User::count());
        $this->assertAuthenticatedAs(User::first());
    }

    /** @test */
    public function error_shown_when_model_not_found_and_creation_not_allowed(): void
    {
        config()->set('envx.auth-handler.creates', false);

        self::assertEquals(0, User::count());

        $this->post(route('login'), [
            'email' => 'user@doesntexist.com'
        ])->assertSessionHasErrors([
            'email' => 'The email or password is incorrect. Please try again or click forgot your password.',
        ]);

        $this->assertGuest();

        self::assertEquals(0, User::count());
    }
}
