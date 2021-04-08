<?php

namespace Tests\Unit\Admin;

use App\Admin;
use App\EnvX\Admin\AdminCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Two\User;
use RoleSeeder;
use Tests\TestCase;

class AdminCreatorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);
    }

    private function creator(): AdminCreator
    {
        return (new AdminCreator());
    }

    private function adfsUser(...$groups): User
    {
        return (new User)->map([
            'id' => 'admin@example.com',
            'given_name' => 'Test',
            'family_name' => 'Testerson',
            'email' => 'admin@example.com',
        ])->setRaw(['groups' => $groups]);
    }

    /** @test */
    public function creates_admins(): void
    {
        self::assertEquals(0, Admin::count());

        $admin = $this->creator()->create([
            'forename' => 'Test',
            'surname' => 'Testerson',
            'email' => 'admin@example.com',
        ], Admin::ROLE_ROOT);

        self::assertEquals(1, Admin::count());
        self::assertEquals($admin->id, Admin::first()->id);
        self::assertEquals(Admin::ROLE_ROOT, $admin->roles()->first()->name);
    }

    /** @test */
    public function updates_or_creates_basic_admin_from_socialite_adfs_user(): void
    {
        $adfsUser = $this->adfsUser();

        $admin = $this->creator()->handleAdfs($adfsUser);

        self::assertEquals(1, Admin::count());
        self::assertEquals($adfsUser->id, Admin::first()->adfs_id);

        self::assertEquals(1, $admin->roles->count());
        self::assertTrue($admin->hasRole(Admin::ROLE_BASIC));
    }

    /** @test */
    public function updates_or_creates_root_admin_from_socialite_adfs_user_if_in_developer_adfs_group(): void
    {
        $admin = $this->creator()->handleAdfs($this->adfsUser(Admin::ADFS_GROUP_DEVELOPERS));

        self::assertTrue($admin->hasRole(Admin::ROLE_ROOT));
    }

    /** @test */
    public function roles_are_only_assigned_to_new_admins(): void
    {
        $admin = $this->creator()->handleAdfs($this->adfsUser());

        self::assertEquals(1, $admin->roles->count());
        self::assertEquals(Admin::ROLE_BASIC, $admin->roles->first()->name);

        $updatedAdmin = $this->creator()->handleAdfs($this->adfsUser([Admin::ADFS_GROUP_DEVELOPERS]));

        self::assertEquals(1, $updatedAdmin->roles->count());
        self::assertEquals(Admin::ROLE_BASIC, $updatedAdmin->roles->first()->name);
    }

    /** @test */
    public function provides_the_default_creation_values(): void
    {
        $defaults = AdminCreator::defaults();
        self::assertCount(2, $defaults);

        self::assertArrayHasKey('password', $defaults);
        self::assertIsString($defaults['password']);

        self::assertEquals(0, $defaults['setup_complete']);
    }
}
