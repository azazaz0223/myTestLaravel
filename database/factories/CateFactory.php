<?php

namespace Database\Factories;

use App\Models\Cate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cate>
 */
class CateFactory extends Factory
{
    protected $model = Cate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'name' => $this->faker->unique()->name,
            'enabled' => $this->faker->boolean,
            'sort' => $this->faker->numberBetween(1, 1000),
            'operator_id' => User::all()->random()->id
        ];
    }
}