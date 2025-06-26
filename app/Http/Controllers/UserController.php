<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class UserController extends Controller
{
     // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login'); // Assure-toi que ce fichier existe
    }
     // Gère la tentative de connexion
    public function login(Request $request)
    {
        // Valide les champs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tente la connexion
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔁 Redirige vers TA VUE PERSONNALISÉE
            return redirect()->route('visiteurs.form'); // <-- change ce nom de route
        }

        // En cas d'échec
        return back()->withErrors([
            'email' => 'Les identifiants sont invalides.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
