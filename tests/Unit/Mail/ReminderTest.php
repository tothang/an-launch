<?php

namespace Tests\Unit\Mail;

use App\Mail\Reminder;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReminderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contains_admins_authentication_token(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create();

        $mailable = (new Reminder($user))->build();

        self::assertEquals($user->getToken()->token, $mailable->viewData['token']);
    }
}
