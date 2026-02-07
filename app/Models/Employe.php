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
}
