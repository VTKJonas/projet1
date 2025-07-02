<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', // Nom du visiteur
        'prenom', // Prénom du visiteur
        'sexe',
        'date',
        'heure_arrivee',
        // 'heure_depart', // <-- Cette ligne a été supprimée
        'motif',
        'locataire_id',
        'confirmee',
    ];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }
}
