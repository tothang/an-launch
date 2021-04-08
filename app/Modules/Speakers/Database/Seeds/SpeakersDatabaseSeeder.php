<?php

namespace App\Modules\Speakers\Database\Seeds;

use Illuminate\Database\Seeder;

class SpeakersDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SpeakerSeeder::class
        ]);
    }
}
