<?php

namespace Tests\Feature\Admin\Auth;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_login_page(): void
    {
        $this->markTestSkipped();
        $this->get(route('admin.login'))
            ->assertViewIs('admin.login')
            ->assertSeeText('Forgot your password?');
    }

    /** @test */
    public function can_login(): void
    {
        $admin = factory(Admin::class)->create();

        $this->post(route('admin.login'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    /** @test */
    public function see_recaptcha_widget_if_enabled(): void
    {
        $this->markTestSkipped();
        config()->set('envx.recaptcha', false);

        $response = $this->get(route('admin.login'));
        $response->assertDontSee('recaptcha-container');

        config()->set('envx.recaptcha', true);

        $response = $this->get(route('admin.login'));
        $response->assertSee('recaptcha-container');
    }

    /** @test */
    public function redirected_from_login_page_if_authenticated(): void
    {
        $this->markTestSkipped();
        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admin')->get(route('admin.login'));

        $response->assertRedirect(route('admin.dashboard'));
    }
}
