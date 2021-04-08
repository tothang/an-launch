<?php

use App\Config;
use App\EnvX\Database\AutoSeed;

class ConfigSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->refresh(Config::class);
    }
}
