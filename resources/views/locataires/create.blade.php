@extends('layouts.app')

@section('title', 'Ajouter un Locataire')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Ajouter un nouveau locataire</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('locataires.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Champ Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-telegramText mb-1">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-telegramText mb-1">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('prenom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-telegramText mb-1">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent" required>
                @error('telephone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Bâtiment -->
            <div>
                <label for="batiment" class="block text-sm font-medium text-telegramText mb-1">Bâtiment</label>
                <input type="text" id="batiment" name="batiment" value="{{ old('batiment') }}"
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
                        <option value="{{ $type->id }}" {{ old('type_resident_id') == $type->id ? 'selected' : '' }}>
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
            </div>

            <!-- Bouton Enregistrer -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                    <i class="ti ti-device-floppy mr-2"></i> Enregistrer le locataire
                </button>
            </div>
        </form>
    </div>
@endsection
