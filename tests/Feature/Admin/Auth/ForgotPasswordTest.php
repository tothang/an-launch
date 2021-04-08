<?php

namespace Tests\Feature\Admin\Auth;

use App\Admin;
use App\Mail\PasswordReset;
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

        $admin = factory(Admin::class)->create();

        $this->post(route('password.email', ['admin' => true]), [
            'email' => $admin->email,
        ])->assertSessionHas([
            'status' => 'We have e-mailed your password reset link!'
        ]);

        Mail::assertSent(PasswordReset::class, static function ($mail) use ($admin): bool {
            return $mail->hasTo($admin->email);
        });
    }

    /** @test */
    public function submitted_emails_that_do_not_exist_still_appear_successful(): void
    {
        Mail::fake();

        self::assertEquals(0, Admin::count());

        $this->post(route('password.email', ['admin' => true]), [
            'email' => 'email@notfound.com',
        ])->assertSessionHas([
            'status' => 'We have e-mailed your password reset link!'
        ]);

        Mail::assertNothingSent();
    }
}
