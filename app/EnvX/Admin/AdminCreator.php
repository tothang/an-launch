<?php

namespace App\EnvX\Admin;

use App\Admin;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User;

class AdminCreator
{
    public function create(array $data, string $role = Admin::ROLE_BASIC): Admin
    {
        return tap(Admin::create(array_merge(self::defaults(), $data)))
            ->syncRoles($role);
    }

    public function handleAdfs(User $adfsUser): Admin
    {
        $admin = Admin::updateOrCreate([
            'adfs_id' => $adfsUser->id
        ], [
            'email' => $adfsUser->email,
            'forename' => $adfsUser->given_name,
            'surname' => $adfsUser->family_name,
        ]);

        if ($admin->roles->count() === 0) {
            $admin->syncRoles(
                in_array(Admin::ADFS_GROUP_DEVELOPERS, $adfsUser['groups'], false)
                    ? Admin::ROLE_ROOT
                    : Admin::ROLE_BASIC
            );
        }

        return $admin;
    }

    public static function defaults(): array
    {
        return [
            'password' => bcrypt(Str::random()),
            'setup_complete' => 0,
        ];
    }
}
