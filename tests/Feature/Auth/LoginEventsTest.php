<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_login_log_created_upon_successful_login(): void
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
            'brand' => 'Hyster',
            'status' => 'password_created',
        ]);

        self::assertEquals(0, $user->loginLogs->count());

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        self::assertEquals(1, $user->fresh()->loginLogs->count());
    }

    /** @test */
    public function user_session_id_updated_upon_successful_login(): void
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
            'status' => 'password_created',
            'brand' => 'Hyster',
        ]);

        self::assertEquals(null, $user->session_id);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        self::assertEquals(session()->getId(), $user->fresh()->session_id);
    }
}
