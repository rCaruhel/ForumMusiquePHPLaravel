<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeDemande>
 */
class TypeDemandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Avis sur une composition',
                'Aide au déchiffrage',
                'Analyse harmonique',
                'Recherche de collaboration',
                'Partage de partition',
                'Question technique (DAW/Instrument)',
                'Arrangement et orchestration',
            ]),
        ];
    }
}
