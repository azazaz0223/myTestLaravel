<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cate_id' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'enabled' => $this->faker->boolean,
            'operator_id' => User::all()->random()->id
        ];
    }
}