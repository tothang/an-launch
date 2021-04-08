<?php

namespace App\EnvX\User;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserCreator
{
    public function create(array $data): User
    {
        if (Arr::has($data, ['forename', 'surname']) === false) {
            $data = array_merge($data, $this->pluckNameFromEmail($data['email']));
        }

        return User::create(array_merge(self::defaults(), $data));
    }

    public static function defaults(): array
    {
        return [
            'password' => bcrypt(Str::random()),
            'api_token' => Str::random(32),
            'setup_complete' => 1
        ];
    }

    public function pluckNameFromEmail(string $email): array
    {
        $local = explode('.', Str::before($email, '@'));

        return [
            'forename' => ucfirst($local[0]),
            'surname' => isset($local[1]) ? ucfirst($local[1]) : null
        ];
    }
}
