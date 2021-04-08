<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    private $passwordResetToken;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->passwordResetToken = app('auth.password.broker')->createToken($this->user);
    }

    /** @test */
    public function can_access_reset_password_page_via_password_reset_email_link(): void
    {
        $this->markTestSkipped();
        $this->get(route('password.reset', $this->passwordResetToken))
            ->assertViewIs('auth.passwords.reset');
    }

    /** @test */
    public function can_submit_and_complete_password_reset_with_valid_token(): void
    {
        $token = $this->passwordResetToken;

        $this->post(route('password.update'), [
            'email' => $this->user->email,
            'password' => 'Password1',
            'password_confirmation' => 'Password1',
            'token' => $token,
        ])->assertRedirect(route('index'));

        $this->assertAuthenticatedAs($this->user);

        self::assertTrue(Hash::check('Password1', $this->user->fresh()->password));
    }

    /** @test */
    public function cannot_complete_password_reset_with_invalid_token(): void
    {
        $token = 'NotValidToken';

        $this->post(route('password.update'), [
            'email' => $this->user->email,
            'password' => 'Password1',
            'password_confirmation' => 'Password1',
            'token' => $token,
        ])->assertSessionHasErrors([
            'email' => 'This password reset token is invalid.'
        ]);

        $this->assertGuest();

        self::assertFalse(Hash::check('Password1', $this->user->fresh()->password));
    }
}
