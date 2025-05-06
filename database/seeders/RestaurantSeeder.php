<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::create([
            'user_id' => 3,
            'restaurantName' => 'Manna Catering',
            'restaurantAddress' => 'Bukit Palma Block A No.11, Surabaya, Jawa Timur',
            'restaurantPhone' => '087766331122'
        ]);
        
    }
}
