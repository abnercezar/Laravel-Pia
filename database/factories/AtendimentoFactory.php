<?php

namespace Database\Factories;

use App\Enums\AtendimentoType;
use App\Models\Irma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atendimento>
 */
class AtendimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'irma_id' => $this->irma()->id,
            'tipo' => $this->faker->randomElement(AtendimentoType::values()),
            'valor' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }

    public function irma(): Irma
    {
        return Irma::first() ?? Irma::factory()->create();
    }
}
