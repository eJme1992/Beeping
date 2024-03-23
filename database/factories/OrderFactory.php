<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_ref' => $this->faker->unique()->word,
            'customer_name' => $this->faker->name,
        ];
    }
}