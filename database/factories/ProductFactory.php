<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph(10),
            'price' => $this->faker->randomFloat(2, 20, 50),
            'stok' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'image' => $this->faker->imageUrl(1920, 1440),
        ];
    }
}
