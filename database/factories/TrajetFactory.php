<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Trajet;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trajet>
 */
class TrajetFactory extends Factory
{
    protected $model = Trajet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDepart = fake()->dateTimeBetween('+1 day', '+1 month');
        $dateArrivee = (clone $dateDepart)->modify('+' . fake()->numberBetween(30, 180) . ' minutes');

        return [
            'voiture_id' => Voiture::factory(),
            'campus_depart_id' => Campus::factory(),
            'campus_arrivee_id' => Campus::factory(),
            'date_time_depart' => $dateDepart,
            'date_time_arrivee' => $dateArrivee,
        ];
    }
}
