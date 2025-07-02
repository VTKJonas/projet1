<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visite;
use App\Models\Locataire;
use App\Notifications\NouvelleVisiteNotification; // Assurez-vous que cette classe existe
use Illuminate\Support\Facades\Storage; // Importez la façade Storage

class VisiteController extends Controller
{
    /**
     * Affiche le formulaire pour ajouter une ou plusieurs visites.
     * Nécessite la liste des locataires pour la sélection.
     * @return \Illuminate\View\View
     */
    
    public function create()
    {
        $locataires = Locataire::all();
        return view('visites.form', compact('locataires')); // <-- Chemin de la vue corrigé ici
    }

    /**
     * Enregistre une ou plusieurs nouvelles visites et envoie des notifications.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'visiteurs.*.nom' => 'required|string|max:255',
            'visiteurs.*.prenom' => 'required|string|max:255',
            'visiteurs.*.sexe' => 'required|string|in:M,F,Autre',
            'visiteurs.*.date' => 'required|date',
            'visiteurs.*.heure_arrivee' => 'required|date_format:H:i',
            'visiteurs.*.motif' => 'required|string|max:255',
            'visiteurs.*.locataire_id' => 'required|exists:locataires,id',
            'visiteurs.*.profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour la photo
        ]);

        foreach ($validatedData['visiteurs'] as $index => $data) {
            $profilePhotoPath = null;
            // Gérer l'upload de la photo de profil si elle est présente
            if ($request->hasFile("visiteurs.{$index}.profile_photo")) {
                $profilePhotoPath = $request->file("visiteurs.{$index}.profile_photo")->store('profile-photos/visiteurs', 'public');
            }

            // Création de la visite dans la table 'visites'
            $visite = Visite::create([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'sexe' => $data['sexe'],
                'date' => $data['date'],
                'heure_arrivee' => $data['heure_arrivee'],
                'motif' => $data['motif'],
                'locataire_id' => $data['locataire_id'],
                'confirmee' => false, // Par défaut, la visite n'est pas confirmée
                'profile_photo_path' => $profilePhotoPath, // Sauvegarde le chemin de la photo
            ]);

            // Envoyer la notification au locataire concerné
            $locataire = Locataire::find($data['locataire_id']);
            if ($locataire) {
                $locataire->notify(new NouvelleVisiteNotification($visite));
            }
        }

        return redirect()->back()->with('success', 'Visite(s) enregistrée(s) et notification(s) envoyée(s) !');
    }

    /**
     * Affiche la liste de toutes les visites.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function liste(Request $request)
    {
        $query = Visite::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhereHas('locataire', function ($q) use ($search) {
                      $q->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%");
                  });
        }

        $visites = $query->latest('date')->get();

        return view('visites.liste', compact('visites'));
    }

    /**
     * Affiche les détails d'une visite spécifique.
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $visite = Visite::findOrFail($id);
        return view('visites.show', compact('visite'));
    }

    /**
     * Affiche la liste des dates uniques de toutes les visites.
     * @return \Illuminate\View\View
     */
    public function listeDates()
    {
        $datesVisites = Visite::select('date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->get();

        return view('visite.dates', compact('datesVisites'));
    }

    /**
     * Marque une visite comme confirmée.
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($id)
    {
        $visite = Visite::findOrFail($id);
        $visite->update(['confirmee' => true]);
        return redirect()->back()->with('success', 'Visite confirmée avec succès !');
    }

    /**
     * Marque une visite comme non confirmée (annulée/refusée).
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unconfirm($id)
    {
        $visite = Visite::findOrFail($id);
        $visite->update(['confirmee' => false]);
        return redirect()->back()->with('success', 'Visite marquée comme non confirmée.');
    }

    /**
     * Supprime une visite.
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $visite = Visite::findOrFail($id);
        // Supprimer la photo de profil associée si elle existe
        if ($visite->profile_photo_path) {
            Storage::disk('public')->delete($visite->profile_photo_path);
        }
        $visite->delete();
        return redirect()->route('visites.liste')->with('success', 'Visite supprimée avec succès.');
    }
}
