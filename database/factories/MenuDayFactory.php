<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuDay>
 */
class MenuDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'foodDate'=> $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'food_id' => Food::inRandomOrder()->first()->id,
        ];
    }
}
