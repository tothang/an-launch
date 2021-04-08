<?php

namespace Tests\Unit\User;

use App\EnvX\User\UserCreator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreatorTest extends TestCase
{
    use RefreshDatabase;

    private function creator(): UserCreator
    {
        return (new UserCreator());
    }

    /** @test */
    public function creates_users(): void
    {
        self::assertEquals(0, User::count());

        $user = $this->creator()->create([
            'forename' => 'Test',
            'surname' => 'Testerson',
            'email' => 'user@example.com',
        ]);

        self::assertEquals(1, User::count());
        self::assertEquals($user->id, User::first()->id);
    }

    /** @test */
    public function creates_users_with_missing_name(): void
    {
        $user = $this->creator()->create([
            'email' => 'user.someone@example.com',
        ]);

        self::assertEquals(1, User::count());
        self::assertEquals($user->forename, User::first()->forename);
        self::assertEquals($user->surname, User::first()->surname);
    }

    /** @test */
    public function provides_the_default_creation_values(): void
    {
        $defaults = UserCreator::defaults();
        self::assertCount(3, $defaults);

        self::assertArrayHasKey('password', $defaults);
        self::assertIsString($defaults['password']);

        self::assertArrayHasKey('api_token', $defaults);
        self::assertIsString($defaults['api_token']);

        self::assertEquals(1, $defaults['setup_complete']);
    }

    /** @test */
    public function guesses_name_from_email_if_not_provided_for_creation(): void
    {
        $creator = $this->creator();

        $expected = [
            'forename' => 'User',
            'surname' => null,
        ];

        self::assertEquals($expected, $creator->pluckNameFromEmail('user@example.com'));

        $expected = [
            'forename' => 'User',
            'surname' => 'Someone',
        ];

        self::assertEquals($expected, $creator->pluckNameFromEmail('user.someone@example.com'));
    }
}
