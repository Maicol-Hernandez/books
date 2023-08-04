<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(50)
            ->create()
            ->each(function (Book $product) {
                $images = Image::factory(mt_rand(2, 4))->make();
                $product->images()->saveMany($images);
            });
    }
}
