<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visiteur;
use App\Models\User;
use App\Models\Visite; 

class VisiteurController extends Controller

{
    public function create()
    {
        return view('visiteurs.form');
    }

   public function store(Request $request)
    {
    $visiteursData = $request->input('visiteurs');

    foreach ($request->visiteurs as $data) {
    $visiteur = new Visiteur();
    $visiteur->nom = $data['nom'];
    $visiteur->prenom = $data['prenom'];
    $visiteur->sexe = $data['sexe'];
    $visiteur->date = $data['date'];
    $visiteur->heure_arrivee = $data['heure_arrivee'];
    $visiteur->motif = $data['motif'];

    // Gérer l'image si présente
    if (isset($data['photo']) && $request->hasFile("visiteurs")) {
        $photoFile = $request->file("visiteurs")[$loop->index]['photo'];
        $photoPath = $photoFile->store('photos_visiteurs', 'public');
        $visiteur->photo = $photoPath;
    }

    $visiteur->save();
}


        return redirect()->route('visiteurs.liste')->with('success', 'Visiteurs enregistrés avec succès.');
    }
    
    public function liste(Request $request)
    {
    $query = Visiteur::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%");
    }

    $visiteurs = $query->latest()->get();

    return view('visiteurs.liste', compact('visiteurs'));
}



        public function listeDates()
    {
         $datesVisites = Visite::select('date')
        ->distinct()
        ->orderBy('date', 'desc')
        ->get();

        return view('visite.dates', compact('datesVisites'));
    }
        
}