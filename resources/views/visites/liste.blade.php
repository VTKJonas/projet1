@extends('layouts.app')

@section('title', 'Liste des Visites')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg overflow-hidden p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Liste des Visites</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Barre de recherche -->
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ route('visites.liste') }}" method="GET" class="w-full sm:w-auto flex-grow">
                <div class="relative">
                    <input type="text" name="search" placeholder="Rechercher par nom, prénom ou locataire..."
                           class="w-full px-4 py-2 pl-10 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                           value="{{ request('search') }}">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>
            <a href="{{ route('visites.create') }}"
               class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md w-full sm:w-auto justify-center">
                <i class="ti ti-user-plus mr-2"></i> Ajouter une visite
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg border border-telegramBorder">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-telegramTableHead text-telegramAccent">
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Photo</th> {{-- Nouvelle colonne --}}
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Visiteur</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Locataire</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Date / Heure</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Motif</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Statut</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visites as $visite)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                            <td class="border border-telegramBorder px-4 py-2">
                                @if($visite->profile_photo_path)
                                    <img src="{{ Storage::url($visite->profile_photo_path) }}" alt="Photo de {{ $visite->prenom }}" class="h-10 w-10 object-cover rounded-full">
                                @else
                                    <img src="https://placehold.co/40x40/cccccc/ffffff?text=NP" alt="Pas de photo" class="h-10 w-10 object-cover rounded-full">
                                @endif
                            </td>
                            <td class="border border-telegramBorder px-4 py-2">{{ $visite->prenom }} {{ $visite->nom }}</td>
                            <td class="border border-telegramBorder px-4 py-2">
                                @if($visite->locataire)
                                    {{ $visite->locataire->prenom }} {{ $visite->locataire->nom }} (Bât. {{ $visite->locataire->batiment }})
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border border-telegramBorder px-4 py-2">
                                {{ \Carbon\Carbon::parse($visite->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($visite->heure_arrivee)->format('H:i') }}
                            </td>
                            <td class="border border-telegramBorder px-4 py-2">{{ $visite->motif }}</td>
                            <td class="border border-telegramBorder px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($visite->confirmee) bg-telegramConfirmed text-white
                                    @else bg-telegramPending text-gray-800 @endif">
                                    {{ $visite->confirmee ? 'Confirmée' : 'En attente' }}
                                </span>
                            </td>
                            <td class="border border-telegramBorder px-4 py-2 flex flex-wrap gap-2">
                                <!-- Voir -->
                                <a href="{{ route('visites.show', $visite->id) }}"
                                   class="bg-telegramAccent text-white px-3 py-1 rounded-md hover:bg-blue-700 text-xs transition shadow-sm">
                                    Voir
                                </a>

                                <!-- Confirmer/Refuser -->
                                @if(!$visite->confirmee)
                                    <form action="{{ route('visites.confirm', $visite->id) }}" method="POST"
                                          onsubmit="return confirm('Voulez-vous vraiment confirmer cette visite ?')">
                                        @csrf
                                        <button type="submit"
                                                class="bg-telegramConfirmed text-white px-3 py-1 rounded-md hover:bg-green-700 text-xs transition shadow-sm">
                                            Confirmer
                                        </button>
                                    </form>
                                    <form action="{{ route('visites.unconfirm', $visite->id) }}" method="POST"
                                          onsubmit="return confirm('Voulez-vous vraiment refuser cette visite ?')">
                                        @csrf
                                        <button type="submit"
                                                class="bg-telegramRejected text-white px-3 py-1 rounded-md hover:bg-red-600 text-xs transition shadow-sm">
                                            Refuser
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('visites.unconfirm', $visite->id) }}" method="POST"
                                          onsubmit="return confirm('Voulez-vous vraiment annuler la confirmation de cette visite ?')">
                                        @csrf
                                        <button type="submit"
                                                class="bg-gray-500 text-white px-3 py-1 rounded-md hover:bg-gray-600 text-xs transition shadow-sm">
                                            Annuler conf.
                                        </button>
                                    </form>
                                @endif

                                <!-- Supprimer -->
                                <form action="{{ route('visites.destroy', $visite->id) }}" method="POST"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cette visite ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-xs transition shadow-sm">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500 italic"> {{-- Colspan ajusté --}}
                                Aucune visite enregistrée pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
