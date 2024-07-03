<?php

namespace Database\Factories;

use App\Models\Api\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductFactory extends Factory
{
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->domainWord,
            'categories' => $this->faker->numberBetween(1,5),
            'quantity' => $this->faker->randomNumber(),
            'manufacturer' => $this->faker->company(),
            'photo_path' => "public/product_image/SeederTest 13.05.24_1715731505.jpeg",
            'status' => 1,
        ];
    }
}
