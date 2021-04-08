<?php

use App\User;
use App\EnvX\User\UserCreator;
use App\EnvX\Database\AutoSeed;

class UserSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->skipOrCreate(User::class, 'email', function (array $user): array {
            return array_merge(UserCreator::defaults(), [
                'password' => bcrypt($user['password']),
            ]);
        });
    }
}
