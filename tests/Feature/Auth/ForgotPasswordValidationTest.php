<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function must_supply_an_email(): void
    {
        $this->post(route('password.email'))
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
            ]);
    }

    /** @test */
    public function must_supply_correctly_formatted_email(): void
    {
        $this->post(route('password.email'), [
            'email' => 'BadlyFormattedEmail',
        ])->assertSessionHasErrors('email', [
            'email' => 'The email must be a valid email address.'
        ]);
    }
}
