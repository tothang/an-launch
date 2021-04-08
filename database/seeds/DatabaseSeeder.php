<?php

use App\EnvX\Facades\ModuleState;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ConfigSeeder::class,
            SegmentSeeder::class,
            UserSeeder::class,
        ]);

        foreach(ModuleState::getEnabled() as $slug) {
            $this->command->call('module:seed', ['slug' => $slug, '--force' => true]);
        }
    }
}
