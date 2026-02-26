<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rental;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SportSeeder::class,
            CategorySeeder::class,
            EquipmentSeeder::class,
            EquipmentSportSeeder::class
        ]);

        User::factory(10)->create();
        Rental::factory(10)->create();
        Review::factory(10)->create();
    }
}
