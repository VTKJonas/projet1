<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Locataire extends Model
{   
    
    protected $fillable = ['nom', 'prenom', 'telephone', 'batiment'];
    use Notifiable;
    
}

