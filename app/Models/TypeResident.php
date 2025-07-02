<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeResident extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    /**
     * Relation : Un type de résident peut avoir plusieurs locataires.
     */
    public function locataires()
    {
        return $this->hasMany(Locataire::class);
    }
}
