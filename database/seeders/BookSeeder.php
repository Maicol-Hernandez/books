<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservarions = Reservation::all();
        $orders = Order::all();

        Book::factory(50)
            ->create()
            ->each(function (Book $book) use ($reservarions, $orders): void {
                $reservarion = $reservarions->random();

                $reservarion->books()->attach([
                    $book->id => [
                        'start_date' => now(),
                        'end_date' => now()->addDays(5)
                    ],
                ]);

                $orders = $orders->random();

                // $orders->books()->attach([
                //     $book->id => ['quantity' => mt_rand(1, 3)]
                // ]);

                $images = Image::factory(mt_rand(2, 4))->make();

                $book->images()->saveMany($images);
            });
    }
}
