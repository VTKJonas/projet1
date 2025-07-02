@extends('layouts.app')

@section('title', 'Détails de la Visite')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg overflow-hidden p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Détails de la Visite</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Informations Visiteur -->
            <div class="bg-telegramBg p-4 rounded-lg border border-telegramBorder">
                <h2 class="text-xl font-semibold text-telegramAccent mb-4">Informations du Visiteur</h2>
                <div class="flex items-center mb-4">
                    @if($visite->profile_photo_path)
                        <img src="{{ Storage::url($visite->profile_photo_path) }}" alt="Photo de {{ $visite->prenom }}" class="h-24 w-24 object-cover rounded-full mr-4 border border-telegramBorder">
                    @else
                        <img src="https://placehold.co/96x96/cccccc/ffffff?text=NP" alt="Pas de photo" class="h-24 w-24 object-cover rounded-full mr-4 border border-telegramBorder">
                    @endif
                    <div>
                        <p><strong>Nom:</strong> {{ $visite->nom }}</p>
                        <p><strong>Prénom:</strong> {{ $visite->prenom }}</p>
                        <p><strong>Sexe:</strong> {{ $visite->sexe }}</p>
                    </div>
                </div>
                <p><strong>Motif:</strong> {{ $visite->motif }}</p>
            </div>

            <!-- Informations Visite -->
            <div class="bg-telegramBg p-4 rounded-lg border border-telegramBorder">
                <h2 class="text-xl font-semibold text-telegramAccent mb-4">Détails de la Visite</h2>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($visite->date)->format('d/m/Y') }}</p>
                <p><strong>Heure d'arrivée:</strong> {{ \Carbon\Carbon::parse($visite->heure_arrivee)->format('H:i') }}</p>
                <p><strong>Statut:</strong>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        @if($visite->confirmee) bg-telegramConfirmed text-white
                        @else bg-telegramPending text-gray-800 @endif">
                        {{ $visite->confirmee ? 'Confirmée' : 'En attente' }}
                    </span>
                </p>
            </div>
            
            <!-- Informations Locataire -->
            <div class="bg-telegramBg p-4 rounded-lg border border-telegramBorder md:col-span-2">
                <h2 class="text-xl font-semibold text-telegramAccent mb-4">Locataire Concerné</h2>
                @if($visite->locataire)
                    <div class="flex items-center mb-4">
                        @if($visite->locataire->profile_photo_path)
                            <img src="{{ Storage::url($visite->locataire->profile_photo_path) }}" alt="Photo de {{ $visite->locataire->prenom }}" class="h-20 w-20 object-cover rounded-full mr-4 border border-telegramBorder">
                        @else
                            <img src="https://placehold.co/80x80/cccccc/ffffff?text=NP" alt="Pas de photo" class="h-20 w-20 object-cover rounded-full mr-4 border border-telegramBorder">
                        @endif
                        <div>
                            <p><strong>Nom:</strong> {{ $visite->locataire->nom }}</p>
                            <p><strong>Prénom:</strong> {{ $visite->locataire->prenom }}</p>
                            <p><strong>Téléphone:</strong> {{ $visite->locataire->telephone }}</p>
                            <p><strong>Bâtiment:</strong> {{ $visite->locataire->batiment }}</p>
                            @if($visite->locataire->typeResident)
                                <p><strong>Type de résident:</strong> {{ $visite->locataire->typeResident->libelle }}</p>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="italic text-gray-500">Aucun locataire associé à cette visite.</p>
                @endif
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="flex flex-wrap gap-4 mt-8 justify-center">
            <a href="{{ route('visites.liste') }}"
               class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition duration-200 shadow-md">
                <i class="ti ti-arrow-left mr-2"></i> Retour à la liste
            </a>

            <!-- Confirmer/Refuser/Annuler confirmation -->
            @if(!$visite->confirmee)
                <form action="{{ route('visites.confirm', $visite->id) }}" method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment confirmer cette visite ?')">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramConfirmed hover:bg-green-700 transition duration-200 shadow-md">
                        <i class="ti ti-check mr-2"></i> Confirmer la visite
                    </button>
                </form>
                <form action="{{ route('visites.unconfirm', $visite->id) }}" method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment refuser cette visite ?')">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramRejected hover:bg-red-600 transition duration-200 shadow-md">
                        <i class="ti ti-x mr-2"></i> Refuser la visite
                    </button>
                </form>
            @else
                <form action="{{ route('visites.unconfirm', $visite->id) }}" method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment annuler la confirmation de cette visite ?')">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 transition duration-200 shadow-md">
                        <i class="ti ti-rotate-left mr-2"></i> Annuler confirmation
                    </button>
                </form>
            @endif

            <!-- Supprimer -->
            <form action="{{ route('visites.destroy', $visite->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette visite ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 transition duration-200 shadow-md">
                    <i class="ti ti-trash mr-2"></i> Supprimer la visite
                </button>
            </form>
        </div>
    </div>
@endsection
