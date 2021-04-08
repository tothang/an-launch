<?php

namespace Tests\Unit\Mail;

use App\Admin;
use App\Mail\TempPassword;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TempPasswordTest extends TestCase
{
    use RefreshDatabase;

    private function emailFor(Authenticatable $model): TempPassword
    {
        return (new TempPassword($model, 'tempPassword'))->build();
    }

    /** @test */
    public function returns_correct_route_for_model_type(): void
    {
        $mailable = $this->emailFor(factory(User::class)->create());

        self::assertEquals(route('login'), $mailable->getRoute());

        $mailable = $this->emailFor(factory(Admin::class)->create());

        self::assertEquals(route('admin.login'), $mailable->getRoute());
    }

    /** @test */
    public function falsifies_the_models_setup_flag(): void
    {
        $user = factory(User::class)->create([
            'setup_complete' => 1,
        ]);

        $this->emailFor($user);

        self::assertEquals(0, $user->setup_complete);
    }

    /** @test */
    public function sets_the_users_password_to_the_temporary_one_specified(): void
    {
        $user = factory(User::class)->create();

        $this->emailFor($user);

        self::assertTrue(Hash::check('tempPassword', $user->password));
    }
}
