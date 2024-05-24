<?php

namespace Database\Factories;

use App\Models\Api\StatusModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusModel>
 */
class StatusFactory extends Factory
{
    protected $model = StatusModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
