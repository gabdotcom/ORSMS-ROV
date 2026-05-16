<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PlantillaPositionSeeder::class,
            EligibilityTypeSeeder::class,
            DocumentTypeSeeder::class,
        ]);
    }
}