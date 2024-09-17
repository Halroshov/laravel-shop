<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(0, 1000),
            'warehouse_location' => $this->faker->streetAddress,
        ];
    }
}