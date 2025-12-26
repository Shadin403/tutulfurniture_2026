<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'material' => $this->faker->word(),
            'dimensions' => $this->faker->randomFloat(2, 1, 10),
            'weight' => $this->faker->randomFloat(2, 1, 10),
            'color' => $this->faker->colorName(),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'regular_price' => $this->faker->randomFloat(2, 10, 100),
            'discount_price' => $this->faker->randomFloat(2, 10, 100),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'extra_info' => $this->faker->sentence(),
            'discount_time' => $this->faker->time(),

        ];
    }
}
