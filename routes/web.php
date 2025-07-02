<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\LocataireController;
use App\Http\Controllers\TypeResidentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;


// Route de base (page d'accueil ou redirection)
Route::get('/', function () {
    // Redirige vers la page de connexion par défaut si non authentifié
    // ou vers la page des visites si authentifié
    return redirect()->route('login');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Groupe de routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {

    // --------------------------------------------------------------------
    // Routes pour les Paramètres de l'Application (gérées par SettingsController)
    // --------------------------------------------------------------------
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::post('/settings/reset', [SettingsController::class, 'reset'])->name('settings.reset');
    Route::delete('/settings/clear-all', [SettingsController::class, 'clearAll'])->name('settings.clearAll');


    // --------------------------------------------------------------------
    // Routes pour les Visites (gérées par VisiteController)
    // --------------------------------------------------------------------
    Route::get('/visites/create', [VisiteController::class, 'create'])->name('visites.create');
    Route::post('/visites', [VisiteController::class, 'store'])->name('visites.store');
    Route::get('/visites/liste', [VisiteController::class, 'liste'])->name('visites.liste');
    Route::get('/visites/{id}', [VisiteController::class, 'show'])->name('visites.show');
    Route::post('/visites/{id}/confirm', [VisiteController::class, 'confirm'])->name('visites.confirm');
    Route::post('/visites/{id}/unconfirm', [VisiteController::class, 'unconfirm'])->name('visites.unconfirm');
    Route::delete('/visites/{id}', [VisiteController::class, 'destroy'])->name('visites.destroy');
    Route::get('/dates-visites', [VisiteController::class, 'listeDates'])->name('dates.visite');


    // --------------------------------------------------------------------
    // Routes pour les Locataires (gérées par LocataireController)
    // --------------------------------------------------------------------
    Route::resource('locataires', LocataireController::class);


    // --------------------------------------------------------------------
    // Routes pour les Types de Résidents (gérées par TypeResidentController)
    // --------------------------------------------------------------------
    Route::resource('types-resident', TypeResidentController::class);


    // --------------------------------------------------------------------
    // Routes pour les Notifications (gérées par NotificationController)
    // --------------------------------------------------------------------
    Route::post('/notifications/{id}/lue', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/{id}/accepter', [NotificationController::class, 'accepter'])->name('notifications.accepter');
    Route::post('/notifications/{id}/refuser', [NotificationController::class, 'refuser'])->name('notifications.refuser');
    Route::post('/notifications/{id}/bannir', [NotificationController::class, 'bannir'])->name('notifications.bannir');


});

