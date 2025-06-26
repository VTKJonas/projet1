<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visiteur;
use App\Models\User;

class VisiteurController extends Controller

{
    public function create()
    {
        return view('visiteurs.form');
    }

    public function store(Request $request)
    {
        $data = $request->input('visiteurs');
        foreach ($data as $visiteurData) {
            Visiteur::create($visiteurData);
           
        }

        return redirect()->route('visiteurs.liste')->with('success', 'Les visiteurs ont été enregistrés avec succès.');
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



    public function response($id, $response)
        {
            $visiteur = Visiteur::findOrFail($id);

                // Ici, stocker la réponse dans la base, ou envoyer une notification, etc.
            $visiteur->status = $response == 'accept' ? 'Accepté' : 'Refusé';
            $visiteur->save();

            return view('visite.response', compact('visiteur', 'response'));
        }
}