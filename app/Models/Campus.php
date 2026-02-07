<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campuses';

    protected $fillable = [
        'description',
        'adresse',
        'type',
    ];

    /**
     * Relation Frequente - Les employés qui fréquentent ce campus
     */
    public function employes(): BelongsToMany
    {
        return $this->belongsToMany(Employe::class, 'campus_employe', 'campus_id', 'employe_id');
    }

    /**
     * Relation CampusDeDepart - Les trajets partant de ce campus
     */
    public function trajetsDepart(): HasMany
    {
        return $this->hasMany(Trajet::class, 'campus_depart_id');
    }

    /**
     * Relation CampusDArrive - Les trajets arrivant à ce campus
     */
    public function trajetsArrivee(): HasMany
    {
        return $this->hasMany(Trajet::class, 'campus_arrivee_id');
    }
}
