<?php

namespace Tests\Feature\Auth;

use App\Mail\PasswordReset;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_forgotten_password_page(): void
    {
        $this->markTestSkipped();
        $this->get(route('password.request'))
            ->assertViewIs('auth.passwords.email');
    }

    /** @test */
    public function can_submit_email_and_request_password_reset_email(): void
    {
        Mail::fake();
        config()->set('app.brand', 'Hyster');

        $user = factory(User::class)->create([
            'email' => 'user@example.com',
            'brand' => 'Hyster',
        ]);

        $this->post(route('password.email'), [
            'email' => $user->email,
        ])->assertSessionHas([
            'status' => 'We have e-mailed your password reset link!'
        ]);

        Mail::assertSent(PasswordReset::class, static function ($mail) use ($user): bool {
            return $mail->hasTo($user->email);
        });
    }

    /** @test */
    public function submitted_emails_that_do_not_exist_still_appear_successful(): void
    {
        Mail::fake();

        self::assertEquals(0, User::count());

        $this->post(route('password.email'), [
            'email' => 'email@notfound.com',
        ])->assertSessionHas([
            'status' => 'We have e-mailed your password reset link!'
        ]);

        Mail::assertNothingSent();
    }
}
