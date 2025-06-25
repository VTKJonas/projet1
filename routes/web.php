<<?php

use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return redirect()->route('visiteur.create');
});

// Formulaire 1
Route::get('/visiteur', [VisiteurController::class, 'create'])->name('visiteur.create');
Route::post('/visiteur', [VisiteurController::class, 'store'])->name('visiteur.store');

// Formulaire 2
Route::get('/userinfo', [UserInfoController::class, 'create'])->name('userinfo.create');
Route::post('/userinfo', [UserInfoController::class, 'store'])->name('userinfo.store');

Route::get('/dashboard', function () {
    return 'Bienvenue dans le dashboard !';
})->middleware('auth');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/formulaire', [VisiteurController::class, 'create'])->name('visiteur.create');
Route::post('/formulaire', [VisiteurController::class, 'store'])->name('visiteur.store');


// Page après connexion
Route::get('/visite', function () {
    return view('form1');
})->name('visite')->middleware('auth');







