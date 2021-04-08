<?php

namespace App\Modules\Speakers\Database\Seeds;

use App\EnvX\Database\AutoSeed;
use App\Modules\Speakers\Models\Speaker;

class SpeakerSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->updateOrCreate(Speaker::class, 'name', static function (): array {
            return [
                'day' => 1,
                'questionable' => 1,
                'agendable' => 0,
            ];
        });
    }
}
