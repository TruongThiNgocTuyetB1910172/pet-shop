<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'description' => fake()->text,
            'sku' => fake()->numberBetween(10000, 99999),
            'stock' => fake()->numberBetween(10, 1000),
            'original_price' => fake()->numberBetween(100000, 10000000),
            'selling_price' => fake()->numberBetween(100000, 10000000),
            'image' => fake()->imageUrl,
            'category_id' => fake()->numberBetween(1, 10),
            'feature' => rand(0, 1),
        ];
    }
}
