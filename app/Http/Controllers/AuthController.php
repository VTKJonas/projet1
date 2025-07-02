<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Pour le hachage du mot de passe si vous créez des utilisateurs manuellement
use App\Models\User; // Assurez-vous d'importer le modèle User

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Assurez-vous que vous avez une vue 'auth/login.blade.php'
    }

    /**
     * Gère la tentative de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Puisque nous n'avons plus de rôle 'admin', nous redirigeons simplement l'utilisateur connecté
            // vers la page de liste des visites, ou une autre page par défaut.
            return redirect()->intended('/visites/liste'); // Redirige vers la page prévue ou /visites/liste
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte l'utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); 
    }


}
