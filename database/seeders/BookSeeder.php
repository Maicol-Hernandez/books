<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
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
        $categories = Category::all();

        Book::factory(50)
            ->create()
            ->each(function (Book $book) use ($reservarions, $categories): void {
                $reservarion = $reservarions->random();

                $reservarion->books()->attach([
                    $book->id => [
                        'start_date' => now()->subDays(3),
                        'end_date' => now()->subDays(1)
                    ],
                ]);

                $category = $categories->random();

                $category->books()->attach([
                    $book->id => [],
                ]);

                $images = Image::factory(mt_rand(2, 4))->make();
                $book->images()->saveMany($images);
            });
    }
}
