<?php

namespace Database\Factories;

use App\Models\Groupe;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'description' => fake()->text(),
            'group_id' => fake()->boolean(20) ? Groupe::all()->random()->id : null,
            'email_verified_at' => now(),
            'is_admin' => false,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            if (Instrument::count() > 0) {
                $instruments = Instrument::inRandomOrder()
                    ->limit(rand(1, 3))
                    ->get();
                $user->instruments()->attach($instruments);
            }

        });
    }
}
