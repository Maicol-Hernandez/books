<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservarions = Reservation::all();

        Book::factory(50)
            ->create()
            ->each(function (Book $book) use ($reservarions): void {
                $reservarion = $reservarions->random();

                $reservarion->books()->attach([
                    $book->id => [
                        'start_date' => now()->subDays(3),
                        'end_date' => now()->subDays(1)
                    ],
                ]);

                $images = Image::factory(mt_rand(2, 4))->make();
                $book->images()->saveMany($images);
            });
    }
}
