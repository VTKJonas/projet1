<?php

namespace App\Http\Controllers;

use App\Models\Locataire;

use App\Models\TypeResident;

use Illuminate\Http\Request;

class LocataireController extends Controller
{
      public function create()
    {
        $typesResidents = TypeResident::all();
        return view('locataires.create', compact('typesResidents'));
    }
    // Enregistre un locataire en base de données
   public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'batiment' => 'required|string',
        ]);

        Locataire::create($request->only(['nom', 'prenom', 'telephone', 'batiment']));

        return redirect()->route('locataires.index')->with('success', 'Locataire ajouté avec succès !');
    }

    public function show($id)
    {
    $locataire = Locataire::findOrFail($id);
    return view('locataires.show', compact('locataire'));
    }
    

      public function index()
    {
        $locataires = Locataire::all();
        return view('locataires.index', compact('locataires'));
    }

    public function destroy($id)
    {
    $locataire = Locataire::findOrFail($id);
    $locataire->delete();

    return redirect()->route('locataires.create')
                     ->with('success', 'Locataire supprimé avec succès.');
    }

}
