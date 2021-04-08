<?php

namespace Tests\Feature\Admin;

use App\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_dashboard(): void
    {
        $this->markTestIncomplete();
        $this->actingAs(factory(Admin::class)->create(), 'admin')
            ->get(route('admin.dashboard'))
            ->assertViewIs('admin.dashboard');
    }
}
