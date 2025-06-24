<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Cette ligne est cruciale
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory; // Utilise le trait correctement importé

    protected $fillable = [
        'nom', 'prenom', 'date', 'heure_arrivee', 'heure_depart', 'motif'
    ];
}