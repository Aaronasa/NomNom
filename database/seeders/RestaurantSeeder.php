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
            'restaurantName' => 'Manna Catering',
            'restaurantAddress' => 'Bukit Palma Block A No.11, Surabaya, Jawa Timur',
            'restaurantPhone' => '087766331122'
        ]);
        Restaurant::create([
            'restaurantName' => 'Selera Nusantara',
            'restaurantAddress' => 'Jl. Merdeka No. 45, Bandung, Jawa Barat',
            'restaurantPhone' => '081234567890'
        ]);

        Restaurant::create([
            'restaurantName' => 'Sumatera Catering',
            'restaurantAddress' => 'Jl. Sudirman No. 21, Padang, Sumatera Barat',
            'restaurantPhone' => '082345678901'
        ]);

        Restaurant::create([
            'restaurantName' => 'Madura Racing Catering',
            'restaurantAddress' => 'Jl. Pettarani No. 88, Bangkalan , Madura',
            'restaurantPhone' => '083456789012'
        ]);

        Restaurant::create([
            'restaurantName' => 'Jawa Resto',
            'restaurantAddress' => 'Jl. Malioboro No. 99, Yogyakarta, DIY',
            'restaurantPhone' => '084567890123'
        ]);
        Restaurant::create([
            'restaurantName' => 'Dapur Solo Catering',
            'restaurantAddress' => 'Jl. Danau Sunter Utara No. 27, Jakarta Utara, DKI Jakarta',
            'restaurantPhone' => '021 6583 3963'
        ]);
        
        Restaurant::create([
            'restaurantName' => 'Hanamasa Catering',
            'restaurantAddress' => 'Jl. MH Thamrin Kav. 28-30, Jakarta Pusat, DKI Jakarta',
            'restaurantPhone' => '021 3192 3000'
        ]);
        
        Restaurant::create([
            'restaurantName' => 'Bungasari Catering',
            'restaurantAddress' => 'Jl. Dr. Sutomo No. 6, Semarang, Jawa Tengah',
            'restaurantPhone' => '024 356 6990'
        ]);
        
        Restaurant::create([
            'restaurantName' => 'Ny. Suharti Catering',
            'restaurantAddress' => 'Jl. Jendral Sudirman No. 42, Yogyakarta, DIY Yogyakarta',
            'restaurantPhone' => '0274 586 928'
        ]);
        
        Restaurant::create([
            'restaurantName' => 'Pagi Sore Catering',
            'restaurantAddress' => 'Jl. KH Ahmad Dahlan No. 37, Palembang, Sumatera Selatan',
            'restaurantPhone' => '0711 353 828'
        ]);
        
    }
}
