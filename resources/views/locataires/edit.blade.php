@extends('layouts.app')

@section('title', 'Modifier un Locataire')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Modifier le locataire : {{ $locataire->prenom }} {{ $locataire->nom }}</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6 border border-red-400">
                <p class="font-bold">Oups ! Il y a eu des problèmes avec votre soumission :</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('locataires.update', $locataire->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT') {{-- Utilise la méthode PUT pour la mise à jour --}}

            <!-- Champ Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-telegramText mb-1">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $locataire->nom) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-telegramText mb-1">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $locataire->prenom) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('prenom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-telegramText mb-1">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $locataire->telephone) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('telephone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Bâtiment -->
            <div>
                <label for="batiment" class="block text-sm font-medium text-telegramText mb-1">Bâtiment</label>
                <input type="text" id="batiment" name="batiment" value="{{ old('batiment', $locataire->batiment) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('batiment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Type de Résident -->
            <div>
                <label for="type_resident_id" class="block text-sm font-medium text-telegramText mb-1">Type de Résident</label>
                <select id="type_resident_id" name="type_resident_id"
                        class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                    <option value="">Sélectionnez un type de résident</option>
                    @foreach($typesResidents as $type)
                        <option value="{{ $type->id }}" {{ old('type_resident_id', $locataire->type_resident_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->libelle }}
                        </option>
                    @endforeach
                </select>
                @error('type_resident_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Photo de profil -->
            <div>
                <label for="profile_photo" class="block text-sm font-medium text-telegramText mb-1">Photo de profil (optionnel)</label>
                <input type="file" id="profile_photo" name="profile_photo"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent">
                @error('profile_photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                @if($locataire->profile_photo_path)
                    <div class="mt-4 flex items-center space-x-4">
                        <p class="text-sm text-gray-600">Photo actuelle :</p>
                        <img src="{{ Storage::url($locataire->profile_photo_path) }}" alt="Photo de profil actuelle" class="h-20 w-20 object-cover rounded-full border border-telegramBorder">
                        <label class="flex items-center text-red-600">
                            <input type="checkbox" name="remove_profile_photo" value="1" class="mr-2"> Supprimer la photo actuelle
                        </label>
                    </div>
                @endif
            </div>

            <!-- Boutons Enregistrer et Annuler -->
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('locataires.show', $locataire->id) }}"
                   class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-200 shadow-md">
                    <i class="ti ti-arrow-left mr-2"></i> Annuler
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                    <i class="ti ti-device-floppy mr-2"></i> Mettre à jour le locataire
                </button>
            </div>
        </form>
    </div>
@endsection
