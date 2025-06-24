<<?php

use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('visiteur.create');
});

// Formulaire 1
Route::get('/visiteur', [VisiteurController::class, 'create'])->name('visiteur.create');
Route::post('/visiteur', [VisiteurController::class, 'store'])->name('visiteur.store');

// Formulaire 2
Route::get('/userinfo', [UserInfoController::class, 'create'])->name('userinfo.create');
Route::post('/userinfo', [UserInfoController::class, 'store'])->name('userinfo.store');