<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $fillable = ['nom', 'prenom', 'sexe', 'date', 'heure_arrivee', 'heure_depart', 'motif'];
    
}
