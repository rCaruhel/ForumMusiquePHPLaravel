<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instrument>
 */
class InstrumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $instruments = ['Guitare', 'Piano', 'Violon', 'Batterie', 'Basse', 'Saxophone', 'Flûte', 'Trompette','MAO'];

        return [
            'name' => fake()->unique()->randomElement($instruments),
        ];
    }
}
