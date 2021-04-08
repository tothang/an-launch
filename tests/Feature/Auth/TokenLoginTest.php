<?php

namespace Tests\Feature\Auth;

use App\Token;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TokenLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_login_with_valid_authentication_token(): void
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();

        $this->get(route('login', ['token' => $token]))
            ->assertRedirect(route('index'));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function cannot_login_with_an_expired_token(): void
    {
        $token = factory(Token::class)->states(['expired'])->create();

        $this->get(route('login', ['token' => $token]))
            ->assertSessionHas([
                'token-expired' => 'This login link has expired, please contact the events team.'
            ]);

        $this->assertGuest();
    }

    /** @test */
    public function cannot_login_with_an_invalid_token(): void
    {
        $this->get(route('login', ['token' => 'not-a-token']))
            ->assertSessionHas([
                'token-expired' => 'This login link has expired, please contact the events team.'
            ]);

        $this->assertGuest();
    }

    /** @test */
    public function authentication_not_attempted_if_no_token_present(): void
    {
        $this->markTestSkipped();
        $this->get(route('login'))
            ->assertViewIs('auth.login')
            ->assertOk();

        $this->assertGuest();
    }
}
