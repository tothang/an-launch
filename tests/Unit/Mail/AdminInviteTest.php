<?php

namespace Tests\Unit\Mail;

use App\Admin;
use App\Mail\AdminInvite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminInviteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contains_admins_authentication_token(): void
    {
        $admin = factory(Admin::class)->create();

        $mailable = (new AdminInvite($admin))->build();

        self::assertEquals($admin->getToken()->token, $mailable->viewData['token']);
    }
}
