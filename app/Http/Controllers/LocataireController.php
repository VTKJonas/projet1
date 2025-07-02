<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use App\Models\TypeResident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importez la façade Storage

class LocataireController extends Controller
{
    public function create()
    {
        $typesResidents = TypeResident::all();
        return view('locataires.create', compact('typesResidents'));
    }

    /**
     * Enregistre un nouveau locataire en base de données.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'batiment' => 'required|string',
            'type_resident_id' => 'required|exists:type_residents,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour la photo
        ]);

        $profilePhotoPath = null;
        // Gérer l'upload de la photo de profil si elle est présente
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile-photos/locataires', 'public');
        }

        Locataire::create(array_merge($request->only(['nom', 'prenom', 'telephone', 'batiment', 'type_resident_id']), [
            'profile_photo_path' => $profilePhotoPath, // Sauvegarde le chemin de la photo
        ]));

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

    /**
     * Affiche le formulaire pour modifier un locataire existant.
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $locataire = Locataire::findOrFail($id);
        $typesResidents = TypeResident::all();
        return view('locataires.edit', compact('locataire', 'typesResidents')); // Assurez-vous d'avoir une vue 'locataires.edit'
    }

    /**
     * Met à jour un locataire existant en base de données.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $locataire = Locataire::findOrFail($id);

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'batiment' => 'required|string',
            'type_resident_id' => 'required|exists:type_residents,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour la photo
        ]);

        $dataToUpdate = $request->only(['nom', 'prenom', 'telephone', 'batiment', 'type_resident_id']);

        // Gérer l'upload de la photo de profil
        if ($request->hasFile('profile_photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($locataire->profile_photo_path) {
                Storage::disk('public')->delete($locataire->profile_photo_path);
            }
            $dataToUpdate['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos/locataires', 'public');
        } elseif ($request->boolean('remove_profile_photo')) { // Option pour supprimer la photo existante
            if ($locataire->profile_photo_path) {
                Storage::disk('public')->delete($locataire->profile_photo_path);
            }
            $dataToUpdate['profile_photo_path'] = null;
        }

        $locataire->update($dataToUpdate);

        return redirect()->route('locataires.show', $locataire->id)->with('success', 'Locataire mis à jour avec succès !');
    }


    public function destroy($id)
    {
        $locataire = Locataire::findOrFail($id);
        // Supprimer la photo de profil associée si elle existe
        if ($locataire->profile_photo_path) {
            Storage::disk('public')->delete($locataire->profile_photo_path);
        }
        $locataire->delete();

        return redirect()->route('locataires.index')
                         ->with('success', 'Locataire supprimé avec succès.');
    }
}
