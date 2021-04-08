<?php

use App\Segment;
use App\EnvX\Database\AutoSeed;

class SegmentSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->refresh(Segment::class);
    }
}
