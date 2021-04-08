<?php

namespace App\Modules\PollsAndQuizzes\Database\Seeds;

use Illuminate\Database\Seeder;

class PollsAndQuizzesDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PollAndQuizSeeder::class
        ]);
    }

}
