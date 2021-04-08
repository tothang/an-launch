<?php

namespace Tests\Unit\Helpers;

use App\Admin;
use App\Providers\AppServiceProvider;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RoleSeeder;
use Tests\TestCase;

class HelperTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function is_admin_test(): void
    {
        $user = factory(User::class)->create();
        $admin = factory(Admin::class)->create();

        $this->actingAs($user);
        self::assertFalse(is_admin());

        $this->actingAs($admin, 'admin');
        self::assertTrue(is_admin());
    }

    /** @test */
    public function is_root_test(): void
    {
        $this->seed(RoleSeeder::class);

        $admin = factory(Admin::class)->create();
        $rootAdmin = factory(Admin::class)->create()->assignRole('root');

        $this->actingAs($admin, 'admin');
        self::assertFalse(is_root());

        $this->actingAs($rootAdmin, 'admin');
        self::assertTrue(is_root());
    }

    /** @test */
    public function app_auto_prefix_test(): void
    {
        self::assertEquals('blank_virtual_event_testing_key', app_auto_prefix('key'));
        self::assertEquals('blank_virtual_event_testing_another_key', app_auto_prefix('another key'));
        self::assertEquals('blank_virtual_event_testing_another_key', app_auto_prefix('another-key'));

        config()->set('app.env', 'live');

        self::assertEquals('blank_virtual_event_live_', app_auto_prefix(''));

        config()->set('app.name', 'example');

        self::assertEquals('example_live_', app_auto_prefix(''));
    }

    /** @test */
    public function display_classname_test(): void
    {
        self::assertEquals('App service provider', display_classname(AppServiceProvider::class));
    }

    /** @test */
    public function s3asset_test(): void
    {
        config()->set('envx.s3-asset-path', 'http://example.cloudfront.net');

        config()->set('app.env', 'local');
        self::assertEquals('http://localhost.test', s3asset());
        self::assertEquals('http://localhost.test/example-path', s3asset('example-path'));

        config()->set('app.env', 'production');
        self::assertEquals('http://example.cloudfront.net', s3asset());
        self::assertEquals('http://example.cloudfront.net/example-path', s3asset('/example-path'));
    }
}
