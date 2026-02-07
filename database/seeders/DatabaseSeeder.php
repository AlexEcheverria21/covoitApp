<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Employe;
use App\Models\Voiture;
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
        // Créer quelques campus
        $campuses = Campus::factory(5)->create();

        // Créer 10 employés, chacun avec 0 à 2 véhicules aléatoirement
        $employes = Employe::factory(10)->create();

        foreach ($employes as $employe) {
            // Nombre aléatoire de véhicules (0, 1 ou 2)
            $nbVehicules = rand(0, 2);

            // Créer les véhicules pour cet employé
            Voiture::factory($nbVehicules)->create([
                'employe_id' => $employe->id,
            ]);

            // Associer l'employé à 1-3 campus aléatoirement (relation Frequente)
            $campusIds = $campuses->random(rand(1, min(3, $campuses->count())))->pluck('id');
            $employe->campus()->attach($campusIds);
        }
    }
}
