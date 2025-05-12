<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'phone' => '08123456789',
            'address' => 'Jalan Raya 10',
            'role_id' => 1,
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => bcrypt('admin1'),
            'phone' => '08123456780',
            'address' => 'Jalan Raya 11',
            'role_id' => 2,
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'username' => 'vendoruser',
            'email' => 'vendor@example.com',
            'password' => bcrypt('vendor'),
            'phone' => '08123456789',
            'address' => 'Jalan Raya 12',
            'role_id' => 3,
            'remember_token' => Str::random(10),
        ]);

        User::factory(99)->create();
    }
}
