<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    public function definition(): array
    {

        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'sub_category_id' => SubCategory::inRandomOrder()->first()->id,
            'SKU' => $this->faker->randomNumber(),
            'stock_status' => $this->faker->randomElement(['instock', 'outofstock']),
            'image' => $this->faker->imageUrl(),
            'quantity' => $this->faker->numberBetween(1, 65535),

        ];
    }
}
