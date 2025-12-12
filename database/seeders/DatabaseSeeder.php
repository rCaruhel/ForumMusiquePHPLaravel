<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Groupe;
use App\Models\Instrument;
use App\Models\Publication;
use App\Models\TypeDemande;
use App\Models\User;
use Database\Factories\TypeDemandeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Groupe::factory(2)->create();

        User::factory()->create([
            'name' => 'Test User',
            'password' => 'bonsoir',
            'email' => 'test@example.com',
            'is_admin' => true,

        ]);
        Instrument::factory(9)->create();

        User::factory(5)->create();


        TypeDemande::factory(6)->create();

        Publication::factory(20)->create();
        Commentaire::factory(150)->create();

    }
}
