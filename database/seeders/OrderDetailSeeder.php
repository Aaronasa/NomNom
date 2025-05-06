<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDetail::factory()->create([
            'price' => 100000,
            'unit'=> 2,
            'deliveryStatus_id' => 1,
            'menuDay_id' => 1,
            'order_id' => 101
        ]);
        OrderDetail::factory(100)->create();
    }
}
