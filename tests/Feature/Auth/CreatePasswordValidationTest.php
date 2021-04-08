<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePasswordValidationTest extends TestCase
{
    use RefreshDatabase;

    private function user(): User
    {
        return factory(User::class)->state('not-setup')->create();
    }

    /** @test */
    public function must_supply_a_password(): void
    {
        $this->markTestIncomplete();
        $this->actingAs($this->user())
            ->post(route('create-password.store'))
            ->assertSessionHasErrors([
                'password' => 'The password field is required.',
            ]);
    }

    /** @test */
    public function must_supply_a_password_that_meets_minimum_length(): void
    {
        $user = $this->user();

        $this->markTestIncomplete();
        $failLength = 7;
        $passLength = 8;

        $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => Str::random($failLength)
            ])
            ->assertSessionHasErrors([
                'password' => 'The password must be at least 8 characters.',
            ]);

        $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => Str::random($passLength)
            ])
            ->assertSessionDoesntHaveErrors([
                'password' => 'The password must be at least 8 characters.',
            ]);
    }

    /** @test */
    public function must_supply_a_valid_format_password(): void
    {
        $user = $this->user();

        $this->markTestIncomplete();
        $invalid = 'password';
        $valid = 'Password1';

        $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => $invalid
            ])
            ->assertSessionHasErrors([
                'password' => 'The password format is invalid.',
            ]);

        $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => $valid
            ])
            ->assertSessionDoesntHaveErrors([
                'password' => 'The password format is invalid.',
            ]);
    }

    /** @test */
    public function must_confirm_the_valid_password(): void
    {
        $this->markTestIncomplete();
        $this->actingAs($this->user())
            ->post(route('create-password.store'), [
                'password' => 'Password1',
            ])
            ->assertSessionHasErrors([
                'password' => 'The password confirmation does not match.',
            ]);
    }

    /** @test */
    public function confirmed_password_must_match(): void
    {
        $this->markTestIncomplete();
        $this->actingAs($this->user())
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation', 'NotTheSamePassword',
            ])
            ->assertSessionHasErrors([
                'password' => 'The password confirmation does not match.',
            ]);
    }
}
