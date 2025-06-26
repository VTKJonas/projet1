<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocataireController extends Controller
{
     public function create()
    {
        return view('locataires.create');
    }

    // Enregistre un locataire en base de données
    public function store(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'batiment' => 'required|in:1er étage,2ème étage,3ème étage',
        ]);

        // Enregistrement en base
        Locataire::create($validated);

        // Redirection avec un message
        return redirect()->route('locataires.create')->with('success', 'Locataire enregistré avec succès.');
    }
}
