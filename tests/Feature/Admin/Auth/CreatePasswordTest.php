<?php

namespace Tests\Feature\Admin\Auth;

use App\Admin;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirected_to_create_password_page_if_setup_incomplete(): void
    {
        $this->markTestIncomplete();
        $admin = factory(Admin::class)->create([
            'setup_complete' => false,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('create-password.show'));
    }

    /** @test */
    public function redirected_from_create_password_page_if_setup_complete(): void
    {
        $this->markTestIncomplete();
        $admin = factory(Admin::class)->create([
            'setup_complete' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('create-password.show'))
            ->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function can_create_password_and_complete_setup(): void
    {
        $this->markTestIncomplete();
        $admin = factory(Admin::class)->create([
            'setup_complete' => false,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('create-password.show'))
            ->assertViewIs('auth.passwords.create');

        $this->actingAs($admin, 'admin')
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]);

        self::assertTrue(Hash::check('Password1', $admin->password));
        self::assertTrue($admin->setup_complete);
    }

    /** @test */
    public function redirected_once_setup_complete(): void
    {
        $this->markTestIncomplete();
        $admin = factory(Admin::class)->create([
            'setup_complete' => false,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]);

        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function cannot_re_submit_password_creation_request_once_setup_complete(): void
    {
        $this->markTestIncomplete();
        $admin = factory(Admin::class)->create([
            'setup_complete' => true,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('create-password.store'), [
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]);

        $response->assertStatus(302)->assertRedirect(route('admin.dashboard'));
    }
}
