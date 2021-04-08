<?php

namespace Tests\Unit\Commands;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RoleSeeder;
use Tests\TestCase;

class MakeAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);
    }

    /** @test */
    public function creates_an_admin(): void
    {
        self::assertEquals(0, Admin::count());

        $this->artisan('envx:make:admin')
            ->expectsQuestion('Enter forename', 'Adrian')
            ->expectsQuestion('Enter surname', 'Adminson')
            ->expectsQuestion('Enter email', 'admin@example.com')
            ->expectsQuestion('Select role', 1)
            ->expectsQuestion('Enter password', 'password');

        self::assertEquals(1, Admin::count());
        self::assertEquals('Adrian', Admin::first()->forename);
    }

    /** @test */
    public function creates_a_default_root_admin(): void
    {
        config()->set('app.env', 'local');

        $this->artisan('envx:make:admin --default')
            ->expectsQuestion('Enter password', 'password');

        self::assertEquals(1, Admin::count());
        self::assertTrue(Admin::first()->hasRole(Admin::ROLE_ROOT));
    }

    /** @test */
    public function default_option_only_available_for_development(): void
    {
        config()->set('app.env', 'production');

        $this->artisan('envx:make:admin --default')
            ->expectsOutput('Default option only available for local development.')
            ->assertExitCode(0);
    }

    /** @test */
    public function fails_on_existing_admin(): void
    {
        factory(Admin::class)->create(['email' => 'test@admin.com']);

        $this->artisan('envx:make:admin')
            ->expectsQuestion('Enter forename', 'Adrian')
            ->expectsQuestion('Enter surname', 'Adminson')
            ->expectsQuestion('Enter email', 'test@admin.com')
            ->expectsQuestion('Select role', 1)
            ->expectsOutput('An admin user with this email already exists.');

        Admin::truncate();
        self::assertEquals(0, Admin::count());

        factory(Admin::class)->create(['email' => 'admin@example.com']);

        config()->set('app.env', 'local');

        $this->artisan('envx:make:admin --default')
            ->expectsOutput('An admin user with this email already exists.');
    }
}
