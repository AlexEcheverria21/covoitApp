<?php

namespace Database\Factories;

use App\Models\Employe;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voiture>
 */
class VoitureFactory extends Factory
{
    protected $model = Voiture::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Liste de modèles de voiture courants
        $modeles = [
            'Renault Clio',
            'Peugeot 308',
            'Citroën C3',
            'Volkswagen Golf',
            'Toyota Yaris',
            'Ford Fiesta',
            'Opel Corsa',
            'Fiat 500',
            'Dacia Sandero',
            'Hyundai i20',
        ];

        return [
            'employe_id' => Employe::factory(),
            'modele' => fake()->randomElement($modeles),
            'nb_places' => fake()->numberBetween(2, 7),
        ];
    }
}
