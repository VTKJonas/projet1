@extends('layouts.app')

@section('title', 'Formulaire des Visites')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg overflow-hidden p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Ajouter une ou plusieurs visites</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- Alpine.js data pour gérer les erreurs de validation et l'initialisation --}}
        <form method="POST" action="{{ route('visites.store') }}" enctype="multipart/form-data" class="space-y-6"
              x-data="{
                  // Initialise 'visites' avec les anciennes données ou un tableau vide
                  visites: @json(old('visiteurs', [])), // <-- MODIFIÉ ICI pour un tableau vide par défaut
                  errors: @json($errors->getMessages()),

                  // Fonction pour obtenir le message d'erreur pour un champ spécifique
                  getError: function(field, index) {
                      const errorKey = `visiteurs.${index}.${field}`;
                      return this.errors[errorKey] ? this.errors[errorKey][0] : '';
                  }
              }"
              x-init="
                  // Si 'visites' est vide (pas d'anciennes données), ajoute un formulaire de visite vide par défaut
                  if (visites.length === 0) {
                      visites.push({ nom: '', prenom: '', sexe: 'M', date: '', heure_arrivee: '', motif: '', locataire_id: '', profile_photo: null });
                  }
              "> {{-- <-- AJOUT DE x-init ICI --}}
            @csrf
            <template x-for="(visite, index) in visites" :key="index">
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6 p-4 bg-telegramBg text-telegramText rounded-lg border border-telegramBorder">
                    <!-- Champ Nom -->
                    <div>
                        <label class="block text-sm font-medium text-telegramText mb-1">Nom</label>
                        <input type="text" x-model="visite.nom" :name="`visiteurs[${index}][nom]`"
                               class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                               :class="{ 'border-red-500': getError('nom', index) }" required>
                        <span x-text="getError('nom', index)" class="text-red-500 text-xs"></span>
                    </div>
                    <!-- Champ Prénom -->
                    <div>
                        <label class="block text-sm font-medium text-telegramText mb-1">Prénom</label>
                        <input type="text" x-model="visite.prenom" :name="`visiteurs[${index}][prenom]`"
                               class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                               :class="{ 'border-red-500': getError('prenom', index) }" required>
                        <span x-text="getError('prenom', index)" class="text-red-500 text-xs"></span>
                    </div>
                    <!-- Champ Sexe -->
                    <div>
                        <label class="block text-sm font-medium text-telegramText mb-1">Sexe</label>
                        <select x-model="visite.sexe" :name="`visiteurs[${index}][sexe]`"
                                class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                                :class="{ 'border-red-500': getError('sexe', index) }" required>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                            <option value="Autre">Autre</option>
                        </select>
                        <span x-text="getError('sexe', index)" class="text-red-500 text-xs"></span>
                    </div>
                    <!-- Champ Date -->
                    <div>
                        <label class="block text-sm font-medium text-telegramText mb-1">Date</label>
                        <input type="date" x-model="visite.date" :name="`visiteurs[${index}][date]`"
                               class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                               :class="{ 'border-red-500': getError('date', index) }" required>
                        <span x-text="getError('date', index)" class="text-red-500 text-xs"></span>
                    </div>
                    <!-- Champ Heure Arrivée -->
                    <div>
                        <label class="block text-sm font-medium text-telegramText mb-1">Arrivée</label>
                        <input type="time" x-model="visite.heure_arrivee" :name="`visiteurs[${index}][heure_arrivee]`"
                               class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                               :class="{ 'border-red-500': getError('heure_arrivee', index) }" required>
                        <span x-text="getError('heure_arrivee', index)" class="text-red-500 text-xs"></span>
                    </div>
                    <!-- Champ Motif -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-telegramText mb-1">Motif</label>
                        <input type="text" x-model="visite.motif" :name="`visiteurs[${index}][motif]`"
                               class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                               :class="{ 'border-red-500': getError('motif', index) }" required>
                        <span x-text="getError('motif', index)" class="text-red-500 text-xs"></span>
                    </div>
                    <!-- Champ Locataire -->
                    <div class="col-span-full">
                        <label class="block text-sm font-medium text-telegramText mb-1">Locataire concerné</label>
                        <select x-model="visite.locataire_id" :name="`visiteurs[${index}][locataire_id]`"
                                class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                                :class="{ 'border-red-500': getError('locataire_id', index) }" required>
                            <option value="">Sélectionnez un locataire</option>
                            @foreach($locataires as $locataire)
                                <option value="{{ $locataire->id }}">{{ $locataire->prenom }} {{ $locataire->nom }} (Bât. {{ $locataire->batiment }})</option>
                            @endforeach
                        </select>
                        <span x-text="getError('locataire_id', index)" class="text-red-500 text-xs"></span>
                    </div>

                    <!-- Champ Photo de profil -->
                    <div class="col-span-full">
                        <label :for="`profile_photo_${index}`" class="block text-sm font-medium text-telegramText mb-1">Photo de profil (optionnel)</label>
                        <input type="file" :id="`profile_photo_${index}`" :name="`visiteurs[${index}][profile_photo]`"
                               class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                               :class="{ 'border-red-500': getError('profile_photo', index) }">
                        <span x-text="getError('profile_photo', index)" class="text-red-500 text-xs"></span>
                    </div>

                    <!-- Bouton Supprimer Visiteur -->
                    <div class="col-span-full flex justify-end">
                        <button type="button" @click="visites.splice(index, 1)"
                                class="text-red-600 hover:text-red-800 p-2 rounded-md hover:bg-red-50" x-show="visites.length > 1">
                            <i class="ti ti-trash"></i> Supprimer ce visiteur
                        </button>
                    </div>
                </div>
            </template>

            <!-- Boutons Ajouter et Enregistrer -->
            <div class="flex flex-wrap gap-4 mt-6">
                <button type="button" @click="visites.push({ nom: '', prenom: '', sexe: 'M', date: '', heure_arrivee: '', motif: '', locataire_id: '', profile_photo: null })"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                    <i class="ti ti-user-plus mr-2"></i> Ajouter un visiteur
                </button>

                <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                    <i class="ti ti-device-floppy mr-2"></i> Enregistrer toutes les visites
                </button>
            </div>
        </form>
    </div>
@endsection
