<?php

namespace Database\Factories;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campus>
 */
class CampusFactory extends Factory
{
    protected $model = Campus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Principal', 'Annexe', 'Recherche', 'Formation'];

        return [
            'description' => 'Campus ' . fake()->city(),
            'adresse' => fake()->address(),
            'type' => fake()->randomElement($types),
        ];
    }
}
