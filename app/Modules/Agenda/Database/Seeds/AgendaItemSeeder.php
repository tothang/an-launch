<?php

namespace App\Modules\Agenda\Database\Seeds;

use App\EnvX\Database\AutoSeed;
use App\Modules\Agenda\Models\AgendaItem;

class AgendaItemSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->refresh(AgendaItem::class);
    }
}
