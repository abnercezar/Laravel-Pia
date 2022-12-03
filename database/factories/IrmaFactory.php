<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Irma>
 */
class IrmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'cpf' => fake()->numberBetween(100, 999).'.'.fake()->numberBetween(100, 999).'.'.fake()->numberBetween(100, 999).'-'.fake()->numberBetween(10, 99),
        ];
    }
}
