<?php

namespace App\Modules\Webinar\Database\Seeds;

use App\Modules\Webinar\Models\Bookmark;
use App\EnvX\Database\AutoSeed;

class BookmarkSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->refresh(Bookmark::class);
    }
}
