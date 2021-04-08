<?php

namespace Tests\Feature\Auth;

use App\Config;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_login_page(): void
    {
        $this->markTestSkipped();
        $this->assertGuest();

        $response = $this->get(route('login'));
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function can_login(): void
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
            'brand' => 'Hyster',
            'status' => 'password_created'
        ]);

        config()->set('envx.auth-handler.creates', true);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('welcome'));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function see_recaptcha_widget_if_enabled(): void
    {
        $this->markTestSkipped();
        config()->set('envx.recaptcha', false);

        $response = $this->get(route('login'));
        $response->assertDontSee('recaptcha-container');

        config()->set('envx.recaptcha', true);

        $response = $this->get(route('login'));
        $response->assertSee('recaptcha-container');
    }

    /** @test */
    public function see_forgotten_password_button_if_active(): void
    {
        $this->markTestSkipped();
        $config = Config::create([
            'key' => 'show_forgot_password',
            'value' => 0,
        ]);

        $config->update(['value' => 1]);
        cache()->clear();

        $response = $this->get(route('login'));
        $response->assertSeeText('Forgotten your password?');
    }

    /** @test */
    public function redirected_to_login_page_from_base_url(): void
    {
        $this->assertGuest();

        $response = $this->get(route('index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function redirected_from_login_page_if_authenticated(): void
    {
        $this->markTestSkipped();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route(app('login.redirect')));
    }
}
