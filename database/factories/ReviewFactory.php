<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $orderDetail = OrderDetail::inRandomOrder()->first();
        return [
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'user_id' => $orderDetail->orderInOrderDetail->user_id ?? User::inRandomOrder()->first()->id,
            'order_detail_id' => $orderDetail->id,
        ];
    }
}