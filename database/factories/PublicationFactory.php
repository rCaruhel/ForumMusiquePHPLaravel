<?php

namespace Database\Factories;

use App\Models\TypeDemande;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'is_request' => $this->faker->boolean(),
            'user_id' => User::all()->random(),
            'demande_id' => TypeDemande::all()->random(),
        ];
    }
}
