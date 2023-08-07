<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ReservationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        $this->call([
            ReservationSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            ImageSeeder::class,
        ]);
    }
}
