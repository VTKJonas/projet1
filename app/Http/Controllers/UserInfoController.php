<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserInfoController extends Controller
{
    public function create(Request $request)
    {
        // Récupérer les données du premier formulaire depuis la session
        $form1Data = $request->session()->get('form1_data');

        return view('form2', [
            'nom' => $form1Data['nom'] ?? '',
            'prenom' => $form1Data['prenom'] ?? ''
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'email' => 'required|email|unique:user_infos,email',
            'password' => 'required|string|min:8',
        ]);

        // Hasher le mot de passe
        $validated['password'] = bcrypt($validated['password']);

        UserInfo::create($validated);

        // Nettoyer la session
        $request->session()->forget('form1_data');

        return redirect()->route('visiteur.create')->with('success', 'Informations enregistrées avec succès!');
    }
}
