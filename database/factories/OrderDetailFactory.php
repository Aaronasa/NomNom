<?php

namespace Database\Factories;

use App\Models\DeliveryStatus;
use App\Models\MenuDay;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 50000, 1000000),
            'unit' => $this->faker->randomNumber(1, 5),
            'deliveryStatus_id' => 1,
            'namapenerima' => $this->faker->name(),
            'image' => $this->faker->imageUrl(640, 480, 'food'),
            'menuDay_id' => MenuDay::inRandomOrder()->first()->id,
            'order_id' => Order::inRandomOrder()->first()->id,
        ];
    }
}
