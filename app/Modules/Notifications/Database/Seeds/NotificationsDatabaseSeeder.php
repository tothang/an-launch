<?php

namespace App\Modules\Notifications\Database\Seeds;

use Illuminate\Database\Seeder;

class NotificationsDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NotificationSeeder::class
        ]);
    }
}
