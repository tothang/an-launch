<?php

namespace Tests\Feature\Auth;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function password_reset_token_must_be_present(): void
    {
        $this->post(route('password.update'))
            ->assertSessionHasErrors([
                'token' => 'The token field is required.',
            ]);
    }

    /** @test */
    public function must_supply_email(): void
    {
        $this->post(route('password.update'))
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
            ]);
    }

    /** @test */
    public function must_supply_correctly_formatted_email(): void
    {
        $this->post(route('password.update'), [
            'email' => 'BadlyFormattedEmail',
        ])->assertSessionHasErrors('email', [
            'email' => 'The email must be a valid email address.'
        ]);
    }

    /** @test */
    public function must_supply_a_password(): void
    {
        $this->post(route('password.update'))
            ->assertSessionHasErrors([
                'password' => 'The password field is required.',
            ]);
    }

    /** @test */
    public function must_supply_a_password_that_meets_minimum_length(): void
    {
        $failLength = 7;
        $passLength = 8;

        $this->post(route('password.update'), [
            'password' => Str::random($failLength)
        ])
        ->assertSessionHasErrors([
            'password' => 'The password must be at least 8 characters.',
        ]);

        $this->post(route('password.update'), [
            'password' => Str::random($passLength),
        ])
        ->assertSessionDoesntHaveErrors([
            'password' => 'The password must be at least 8 characters.',
        ]);
    }

    /** @test */
    public function must_supply_a_valid_format_password(): void
    {
        $invalid = 'password';
        $valid = 'Password1';

        $this->post(route('password.update'), [
            'password' => $invalid
        ])
        ->assertSessionHasErrors([
            'password' => 'The password format is invalid.',
        ]);

        $this->post(route('password.update'), [
            'password' => $valid
        ])
        ->assertSessionDoesntHaveErrors([
            'password' => 'The password format is invalid.',
        ]);
    }

    /** @test */
    public function must_confirm_the_valid_password(): void
    {
        $this->post(route('password.update'), [
            'password' => 'Password1',
        ])
        ->assertSessionHasErrors([
            'password' => 'The password confirmation does not match.',
        ]);
    }

    /** @test */
    public function confirmed_password_must_match(): void
    {
        $this->post(route('password.update'), [
            'password' => 'Password1',
            'password_confirmation', 'NotTheSamePassword',
        ])
        ->assertSessionHasErrors([
            'password' => 'The password confirmation does not match.',
        ]);
    }
}
