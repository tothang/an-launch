<?php

namespace App\Modules\BreakoutRooms\Database\Seeds;

use Illuminate\Database\Seeder;

class BreakoutRoomsDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BreakoutRoomSeeder::class
        ]);
    }
}
