<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text(50),
            'image' => $this->faker->imageUrl(200, 200),
            'category_id' => Category::get()->random()->id,
            'serving' => $this->faker->numberBetween(50, 1000),
            'price' => $this->faker->numberBetween(299, 1999),
            'in_stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
