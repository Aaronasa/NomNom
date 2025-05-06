<?php

namespace Database\Seeders;

use App\Models\DeliveryStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryStatus::create([
            'statusName' => 'Waiting for delivery',
        ]);
        DeliveryStatus::create([
            'statusName' => 'On the delivery way',
        ]);
        DeliveryStatus::create([
            'statusName' => 'already received',
        ]);
    }
}
