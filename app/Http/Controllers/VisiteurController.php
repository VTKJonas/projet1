<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visiteur;

class VisiteurController extends Controller
{
    public function create()
    {
        return view('form1'); // ton formulaire de base
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date' => 'required|date',
            'heure_arrivee' => 'required',
            'heure_depart' => 'required',
            'motif' => 'required|string|max:255',
        ]);

        // Enregistrement en base de données
        $visiteur = Visiteur::create($validated);

        // Rediriger vers une vue récapitulative et lui passer les données du visiteur
        return view('index', ['visiteur' => $visiteur]);
    }
}
