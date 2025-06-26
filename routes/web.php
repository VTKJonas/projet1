<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocataireController;

// Redirection par défaut
Route::get('/', function () {
    return redirect()->route('visiteurs.create'); // page d’ajout des visiteurs
});

// ---------------------------
// Authentification
// ---------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Page protégée après connexion
Route::get('/dashboard', function () {
    return 'Bienvenue dans le dashboard !';
})->middleware('auth');

// ---------------------------
// Formulaires visiteurs
// ---------------------------

// Formulaire pour ajouter plusieurs visiteurs
Route::get('/visiteurs', [VisiteurController::class, 'create'])->name('visiteurs.create');
Route::post('/visiteurs/store', [VisiteurController::class, 'store'])->name('visiteurs.store');

// Liste des visiteurs enregistrés
Route::get('/visiteurs/liste', [VisiteurController::class, 'liste'])->name('visiteurs.liste');

// ---------------------------
// Deuxième formulaire (infos complémentaires ?)
// ---------------------------
Route::get('/userinfo', [UserInfoController::class, 'create'])->name('userinfo.create');
Route::post('/userinfo', [UserInfoController::class, 'store'])->name('userinfo.store');

// Page test protégée (peut être supprimée si inutile)
Route::get('/visite', function () {
    return view('visiteurs.form');
})->middleware('auth')->name('visite');


Route::get('/visiteurs/row/{index}', function ($index) {
    return view('visiteurs.partials.form-row', compact('index'));
});


Route::get('/visiteurs', [VisiteurController::class, 'create'])->name('visiteurs.create');
Route::post('/visiteurs/store', [VisiteurController::class, 'store'])->name('visiteurs.store');
Route::get('/visiteurs/liste', [VisiteurController::class, 'liste'])->name('visiteurs.liste');


Route::get('/visite/response/{id}/{response}', [VisiteurController::class, 'response'])->name('visite.response');


Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Ta vue personnalisée ici
Route::get('/auth.login', function () {
    return view('visiteurs.form'); // ← modifie selon ton fichier blade
})->name('visiteurs.form')->middleware('auth');

Route::get('/locataires/create', [LocataireController::class, 'create'])->name('locataires.create');
Route::post('/locataires', [LocataireController::class, 'store'])->name('locataires.store');