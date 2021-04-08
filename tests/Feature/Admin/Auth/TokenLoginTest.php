<?php

namespace Tests\Feature\Admin\Auth;

use App\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TokenLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_login_with_valid_authentication_token(): void
    {
        $admin = factory(Admin::class)->create();
        $token = $admin->generateToken();

        $this->get(route('login', ['token' => $token]))
            ->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin, 'admin');
    }
}
