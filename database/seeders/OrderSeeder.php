<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Order::factory(10)
            ->make()
            ->each(function (Order $order) use ($users) {
                $order->user_id = $users->random()->id;
                $order->save();
            });
    }
}
