<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trajet extends Model
{
    use HasFactory;

    protected $table = 'trajets';

    protected $fillable = [
        'voiture_id',
        'campus_depart_id',
        'campus_arrivee_id',
        'date_time_depart',
        'date_time_arrivee',
    ];

    protected $casts = [
        'date_time_depart' => 'datetime',
        'date_time_arrivee' => 'datetime',
    ];

    /**
     * Relation Conduit (inverse) - La voiture utilisée pour ce trajet
     */
    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class, 'voiture_id');
    }

    /**
     * Relation CampusDeDepart (inverse) - Le campus de départ
     */
    public function campusDepart(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_depart_id');
    }

    /**
     * Relation CampusDArrive (inverse) - Le campus d'arrivée
     */
    public function campusArrivee(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_arrivee_id');
    }

    /**
     * Relation estPassager - Les employés passagers de ce trajet
     */
    public function passagers(): BelongsToMany
    {
        return $this->belongsToMany(Employe::class, 'employe_trajet', 'trajet_id', 'employe_id')
            ->withPivot('date_inscription');
    }

    /**
     * Accesseur pour obtenir le conducteur (propriétaire de la voiture)
     */
    public function getConducteurAttribute(): ?Employe
    {
        return $this->voiture?->employe;
    }
}
