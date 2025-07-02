<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // <-- Assurez-vous que cette ligne est présente

class Locataire extends Model
{
    use HasFactory, Notifiable; // <-- Assurez-vous que 'Notifiable' est ajouté ici

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'batiment',
        'profile_photo_path', // Assurez-vous que c'est toujours là pour les photos
        'type_resident_id',
    ];

    /**
     * Relation : Un locataire appartient à un TypeResident.
     */
    public function typeResident()
    {
        return $this->belongsTo(TypeResident::class);
    }

    /**
     * Relation : Un locataire peut avoir plusieurs visiteurs.
     */
    public function visiteurs()
    {
        return $this->hasMany(Visiteur::class);
    }

    /**
     * Relation : Un locataire peut avoir plusieurs visites.
     */
    public function visites()
    {
        return $this->hasMany(Visite::class);
    }
}
