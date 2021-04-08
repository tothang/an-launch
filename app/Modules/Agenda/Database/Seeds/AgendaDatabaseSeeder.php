<?php

namespace App\Modules\Agenda\Database\Seeds;

use Illuminate\Database\Seeder;

class AgendaDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AgendaItemSeeder::class
        ]);
    }
}
