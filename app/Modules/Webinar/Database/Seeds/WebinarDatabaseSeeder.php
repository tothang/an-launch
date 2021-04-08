<?php

namespace App\Modules\Webinar\Database\Seeds;

use Illuminate\Database\Seeder;

class WebinarDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StreamSeeder::class,
            BookmarkSeeder::class
        ]);
    }
}
