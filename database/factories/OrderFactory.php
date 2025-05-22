<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'orderDate' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'totalPrice' => $this->faker->randomFloat(2, 100000, 500000),
            'paymentStatus' => $this->faker->boolean() ? 'Paid' : 'UnPaid',
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
