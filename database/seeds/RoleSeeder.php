<?php

use App\EnvX\Database\AutoSeed;
use Spatie\Permission\Models\Role;

class RoleSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->using(__DIR__ . '/../data/roles.csv')
            ->skipOrCreate(Role::class, 'name');
    }
}
