<?php

namespace Tests\Unit\Mail\Hyster;

use App\Config;
use App\Mail\Hyster\Invite;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InviteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contains_users_authentication_token(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create();

        $mailable = (new Invite($user))->build();

        $url = url('/set-password?token=' . $user->getToken()->token);

        self::assertEquals($url, $mailable->viewData['url']);
    }

    /** @test */
    public function falsifies_users_setup_flag(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create([
            'setup_complete' => 1,
        ]);

        (new Invite($user))->build();

        self::assertEquals(0, $user->setup_complete);
    }
}
