<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirected_from_create_password_page_if_setup_complete(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
            'setup_complete' => true,
        ]);

        $this->actingAs($user)
            ->get(route('create-password.show'))
            ->assertRedirect('/');
    }

    /** @test */
    public function can_create_password_and_complete_setup(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
            'setup_complete' => false,
        ]);

        $this->actingAs($user)
            ->get(route('create-password.show'))
            ->assertViewIs('auth.passwords.create');

        $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]);

        self::assertTrue(Hash::check('Password1', $user->password));
        self::assertTrue($user->setup_complete);
    }

    /** @test */
    public function redirected_once_setup_complete(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create([
            'setup_complete' => false,
        ]);

        $response = $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function cannot_re_submit_password_creation_request_once_setup_complete(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create([
            'setup_complete' => true,
        ]);

        $response = $this->actingAs($user)
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]);

        $response->assertStatus(302)->assertRedirect('/');
    }
}
