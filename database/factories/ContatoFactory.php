<?php

namespace Database\Factories;

use App\Models\Irma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contato>
 */
class ContatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => $this->faker->cellphoneNumber(),
            'irma_id' => $this->irma()->id,
        ];
    }

    public function irma(): Irma
    {
        return Irma::first() ?? Irma::factory()->create();
    }
}
