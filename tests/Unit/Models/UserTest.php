<?php

namespace Tests\Unit\Models;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function provides_its_full_name(): void
    {
        $user = factory(User::class)->make([
            'forename' => 'Test',
            'surname' => 'Testerson'
        ]);

        self::assertEquals('Test Testerson', $user->name);
    }
}
