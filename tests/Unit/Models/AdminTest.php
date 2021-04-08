<?php

namespace Tests\Unit\Models;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RoleSeeder;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function provides_its_full_name(): void
    {
        $admin = factory(Admin::class)->make([
            'forename' => 'Adrian',
            'surname' => 'Adminson'
        ]);

        self::assertEquals('Adrian Adminson', $admin->name);
    }

    /** @test */
    public function checks_if_root_admin(): void
    {
        $admin = factory(Admin::class)->create();
        $this->seed(RoleSeeder::class);

        self::assertFalse($admin->isRoot());

        $admin->assignRole(Admin::ROLE_ROOT);

        self::assertTrue($admin->isRoot());
    }
}
