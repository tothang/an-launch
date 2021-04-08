<?php

namespace Tests\Feature\Admin\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function must_supply_an_email(): void
    {
        $this->post(route('admin.login'))->assertSessionHasErrors([
            'email' => 'The email field is required.'
        ]);
    }

    /** @test */
    public function must_supply_a_correctly_formatted_email(): void
    {
        $this->post(route('admin.login'), [
            'email' => 'BadlyFormattedEmail',
        ])->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.'
        ]);
    }

    /** @test */
    public function must_supply_a_password_when_auth_handler_requires_it(): void
    {
        $this->post(route('admin.login'), [
            'email' => 'user@example.com',
        ])->assertSessionHasErrors([
            'password' => 'The password field is required.',
        ]);
    }

    /** @test */
    public function must_complete_recaptcha_if_enabled(): void
    {
        config()->set('envx.recaptcha', true);

        $this->post(route('admin.login'), [
            'email' => 'user@example.com',
        ])->assertSessionHasErrors('g-recaptcha-response');
    }
}
