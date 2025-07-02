@extends('layouts.app')

@section('title', 'Détails du Locataire')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg overflow-hidden p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Détails du Locataire</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Informations Générales -->
            <div class="bg-telegramBg p-4 rounded-lg border border-telegramBorder">
                <h2 class="text-xl font-semibold text-telegramAccent mb-4">Informations Générales</h2>
                <div class="flex items-center mb-4">
                    @if($locataire->profile_photo_path)
                        <img src="{{ Storage::url($locataire->profile_photo_path) }}" alt="Photo de {{ $locataire->prenom }}" class="h-24 w-24 object-cover rounded-full mr-4 border border-telegramBorder">
                    @else
                        <img src="https://placehold.co/96x96/cccccc/ffffff?text=NP" alt="Pas de photo" class="h-24 w-24 object-cover rounded-full mr-4 border border-telegramBorder">
                    @endif
                    <div>
                        <p><strong>Nom:</strong> {{ $locataire->nom }}</p>
                        <p><strong>Prénom:</strong> {{ $locataire->prenom }}</p>
                        <p><strong>Téléphone:</strong> {{ $locataire->telephone }}</p>
                        <p><strong>Bâtiment:</strong> {{ $locataire->batiment }}</p>
                    </div>
                </div>
            </div>

            <!-- Type de Résident -->
            <div class="bg-telegramBg p-4 rounded-lg border border-telegramBorder">
                <h2 class="text-xl font-semibold text-telegramAccent mb-4">Type de Résident</h2>
                @if($locataire->typeResident)
                    <p><strong>Libellé:</strong> {{ $locataire->typeResident->libelle }}</p>
                @else
                    <p class="italic text-gray-500">Aucun type de résident associé.</p>
                @endif
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="flex flex-wrap gap-4 mt-8 justify-center">
            <a href="{{ route('locataires.index') }}"
               class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition duration-200 shadow-md">
                <i class="ti ti-arrow-left mr-2"></i> Retour à la liste
            </a>

            <!-- Bouton Modifier -->
            <a href="{{ route('locataires.edit', $locataire->id) }}"
               class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                <i class="ti ti-edit mr-2"></i> Modifier
            </a>

            <!-- Supprimer -->
            <form action="{{ route('locataires.destroy', $locataire->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce locataire ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 transition duration-200 shadow-md">
                    <i class="ti ti-trash mr-2"></i> Supprimer le locataire
                </button>
            </form>
        </div>
    </div>
@endsection
