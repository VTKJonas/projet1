<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; // <-- AJOUTEZ CETTE LIGNE

class SettingsController extends Controller
{
    /**
     * Affiche le formulaire de paramétrage de l'application.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère tous les paramètres existants sous forme de collection clé => valeur
        $settings = Setting::pluck('value', 'key')->all();

        // Valeurs par défaut si les paramètres n'existent pas encore
        $defaultSettings = [
            'app_name' => 'Gestion App',
            'app_logo' => null, // Chemin vers le logo
            'address' => '123 Rue de l\'Exemple, Ville, Pays',
            'phone_number' => '+1234567890',
            'boss_name' => 'Nom du Responsable',
            'geolocation_lat' => '0.0000', // Latitude par défaut
            'geolocation_lng' => '0.0000', // Longitude par défaut
            'app_theme' => 'light', // Nouvelle valeur par défaut : 'light'
        ];

        // Fusionne les paramètres existants avec les valeurs par défaut
        // Les paramètres existants écrasent les valeurs par défaut
        $settings = array_merge($defaultSettings, $settings);

        return view('settings.index', compact('settings'));
    }

    /**
     * Sauvegarde les paramètres de l'application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'boss_name' => 'required|string|max:255',
            'geolocation_lat' => 'nullable|numeric',
            'geolocation_lng' => 'nullable|numeric',
            'app_theme' => 'required|string|in:light,dark,yellow_soft', // Mise à jour pour inclure 'yellow_soft'
        ]);

        // Gérer l'upload du logo
        if ($request->hasFile('app_logo')) {
            // Supprimer l'ancien logo si un nouveau est uploadé
            $oldLogoPath = Setting::where('key', 'app_logo')->value('value');
            if ($oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                Storage::disk('public')->delete($oldLogoPath);
            }
            // Stocker le nouveau logo
            $logoPath = $request->file('app_logo')->store('logos', 'public');
            $this->saveSetting('app_logo', $logoPath);
        }

        // Sauvegarder les autres paramètres
        $this->saveSetting('app_name', $validatedData['app_name']);
        $this->saveSetting('address', $validatedData['address']);
        $this->saveSetting('phone_number', $validatedData['phone_number']);
        $this->saveSetting('boss_name', $validatedData['boss_name']);
        $this->saveSetting('geolocation_lat', $validatedData['geolocation_lat']);
        $this->saveSetting('geolocation_lng', $validatedData['geolocation_lng']);
        $this->saveSetting('app_theme', $validatedData['app_theme']); // Sauvegarde du thème

        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès !');
    }

    /**
     * Réinitialise tous les paramètres aux valeurs par défaut.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $defaultSettings = [
            'app_name' => 'Gestion App',
            'app_logo' => null,
            'address' => '123 Rue de l\'Exemple, Ville, Pays',
            'phone_number' => '+1234567890',
            'boss_name' => 'Nom du Responsable',
            'geolocation_lat' => '0.0000',
            'geolocation_lng' => '0.0000',
            'app_theme' => 'light', // Valeur par défaut pour la réinitialisation
        ];

        foreach ($defaultSettings as $key => $value) {
            if ($key === 'app_logo' && $value === null) {
                $oldLogoPath = Setting::where('key', 'app_logo')->value('value');
                if ($oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                    Storage::disk('public')->delete($oldLogoPath);
                }
            }
            $this->saveSetting($key, $value);
        }

        return redirect()->back()->with('success', 'Paramètres réinitialisés avec succès !');
    }

    /**
     * Supprime tous les paramètres de la table settings.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearAll()
    {
        Setting::truncate();
        Storage::disk('public')->deleteDirectory('logos'); // Supprime aussi les logos

        return redirect()->route('settings.index')->with('success', 'Tous les paramètres ont été supprimés !');
    }

    /**
     * Helper pour sauvegarder ou mettre à jour un paramètre.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private function saveSetting(string $key, $value): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
