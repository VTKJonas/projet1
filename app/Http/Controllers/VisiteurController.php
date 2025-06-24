<?php


namespace App\Http\Controllers;
use App\Models\Visiteur;

use Illuminate\Http\Request;

class VisiteurController extends Controller
{
     public function create()
    {
        return view('form1');
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

        Visiteur::create($validated);

        // Stocker les données en session pour les réutiliser dans le formulaire 2
        $request->session()->put('form1_data', $validated);

        return redirect()->route('userinfo.create');
    }
}
