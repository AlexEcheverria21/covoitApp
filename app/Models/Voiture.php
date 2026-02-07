<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voiture extends Model
{
    use HasFactory;

    protected $table = 'voitures';

    protected $fillable = [
        'employe_id',
        'modele',
        'nb_places',
    ];

    /**
     * Relation estProprietaire (inverse) - L'employé propriétaire de cette voiture
     */
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    /**
     * Relation Conduit - Les trajets effectués avec cette voiture
     */
    public function trajets(): HasMany
    {
        return $this->hasMany(Trajet::class, 'voiture_id');
    }
}
