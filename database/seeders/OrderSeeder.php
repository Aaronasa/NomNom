<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->create([
            'orderDate' => now()->format('Y-m-d'),
            'totalPrice' => 50000,
            'paymentStatus' => 1,
            'user_id' => 2,
        ]);
        Order::factory(100)->create();
    }
}
