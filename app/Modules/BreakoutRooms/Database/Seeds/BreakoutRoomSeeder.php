<?php

namespace App\Modules\BreakoutRooms\Database\Seeds;

use App\Modules\BreakoutRooms\Models\Breakout;
use App\EnvX\Database\AutoSeed;

class BreakoutRoomSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->refresh(Breakout::class);
    }
}
