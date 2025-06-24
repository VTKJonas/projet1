<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
     use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'tel', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];
}
