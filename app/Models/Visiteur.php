<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'profile_photo_path', // <-- AJOUTEZ CETTE LIGNE
        'locataire_id',
    ];

    /**
     * Get the locataire that owns the visiteur.
     */
    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    /**
     * Get the visites for the visiteur.
     */
    public function visites()
    {
        return $this->hasMany(Visite::class);
    }
}
