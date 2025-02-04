<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, string|float|User>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->word(),
            'description' => fake()->text(250),
            'price' => fake()->randomFloat(45.45, 9999.99),
            'stock_quantity' => fake()->numberBetween(0, 8888),
            'owner_id' => User::query()->firstOr(
                fn () => User::factory()->create()
            ),
        ];
    }
}
