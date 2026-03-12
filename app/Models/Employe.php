<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
    ];

    /**
     * Relation Frequente - Les campus fréquentés par cet employé
     */
    public function campus(): BelongsToMany
    {
        return $this->belongsToMany(Campus::class, 'campus_employe', 'employe_id', 'campus_id');
    }

    /**
     * Relation estProprietaire - Les voitures possédées par cet employé
     */
    public function voitures(): HasMany
    {
        return $this->hasMany(Voiture::class, 'employe_id');
    }

    /**
     * Relation estPassager - Les trajets où cet employé est passager
     */
    public function trajetsPassager(): BelongsToMany
    {
        return $this->belongsToMany(Trajet::class, 'employe_trajet', 'employe_id', 'trajet_id')
            ->withPivot('date_inscription');
    }

    /**
     * i. Compter les voitures d'un employé
     */
    public function compterVoitures(): int
    {
        return $this->voitures()->count();
    }

    /**
     * ii. Vérifier si l'employé possède des véhicules appartenant à un modèle particulier
     */
    public function possedModele(string $modele): bool
    {
        return $this->voitures()->where('modele', $modele)->exists();
    }

    /**
     * iii. Retourner un statut selon le nombre de véhicules possédés
     */
    public function statut(): string
    {
        $nbVoitures = $this->compterVoitures();

        if ($nbVoitures === 0) {
            return 'Pas conducteur';
        } elseif ($nbVoitures === 1) {
            return 'Conducteur';
        } else {
            return 'Conducteur très actif';
        }
    }
}
