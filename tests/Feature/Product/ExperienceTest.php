<?php

namespace Tests\Feature\Product;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirected_correctly_from_index_controller_upon_login(): void
    {
        $this->markTestIncomplete();
        $this->setProductType('experience');

        $this->actingAs(factory(User::class)->create())
            ->get(route('index'))
            ->assertRedirect(route('landing'));
    }
}
