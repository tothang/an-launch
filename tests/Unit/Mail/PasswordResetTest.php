<?php

namespace Tests\Unit\Mail;

use App\Admin;
use App\User;
use App\Mail\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function returns_correct_route_for_model_type(): void
    {
        $user = factory(User::class)->create();
        $mailable = (new PasswordReset($user, 'token'))->build();

        self::assertEquals(route('password.reset', [
            'token' => 'token'
        ]), $mailable->getRoute());

        $admin = factory(Admin::class)->create();
        $mailable = (new PasswordReset($admin, 'token'))->build();

        self::assertEquals(route('password.reset', [
            'token' => 'token',
            'admin' => 1,
        ]), $mailable->getRoute());
    }
}
