@extends('layouts.app')

@section('title', 'Liste des Locataires')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg p-6">

        <h1 class="text-3xl font-bold text-telegramAccent mb-6 text-center">Liste des locataires</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Barre de recherche pour locataires -->
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ route('locataires.index') }}" method="GET" class="w-full sm:w-auto flex-grow">
                <div class="relative">
                    <input type="text" name="search" placeholder="Rechercher par nom, prénom, bâtiment..."
                           class="w-full px-4 py-2 pl-10 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent"
                           value="{{ request('search') }}">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>
            <a href="{{ route('locataires.create') }}"
               class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md w-full sm:w-auto justify-center">
                <i class="ti ti-user-cog mr-2"></i> Ajouter un locataire
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg border border-telegramBorder">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-telegramTableHead text-telegramAccent">
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Photo</th> {{-- Nouvelle colonne --}}
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Nom</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Prénom</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Téléphone</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Bâtiment</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Type Résident</th>
                        <th class="border border-telegramBorder px-4 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locataires as $locataire)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                            <td class="border border-telegramBorder px-4 py-2">
                                @if($locataire->profile_photo_path)
                                    <img src="{{ Storage::url($locataire->profile_photo_path) }}" alt="Photo de {{ $locataire->prenom }}" class="h-10 w-10 object-cover rounded-full">
                                @else
                                    <img src="https://placehold.co/40x40/cccccc/ffffff?text=NP" alt="Pas de photo" class="h-10 w-10 object-cover rounded-full">
                                @endif
                            </td>
                            <td class="border border-telegramBorder px-4 py-2">{{ $locataire->nom }}</td>
                            <td class="border border-telegramBorder px-4 py-2">{{ $locataire->prenom }}</td>
                            <td class="border border-telegramBorder px-4 py-2">{{ $locataire->telephone }}</td>
                            <td class="border border-telegramBorder px-4 py-2">{{ $locataire->batiment }}</td>
                            <td class="border border-telegramBorder px-4 py-2">
                                @if($locataire->typeResident)
                                    {{ $locataire->typeResident->libelle }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border border-telegramBorder px-4 py-2 flex flex-wrap gap-2">
                                <!-- Voir -->
                                <a href="{{ route('locataires.show', $locataire->id) }}"
                                   class="bg-telegramAccent text-white px-3 py-1 rounded-md hover:bg-blue-700 text-xs transition shadow-sm">
                                    Voir
                                </a>
                                <!-- Modifier -->
                                <a href="{{ route('locataires.edit', $locataire->id) }}"
                                   class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 text-xs transition shadow-sm">
                                    Modifier
                                </a>

                                <!-- Supprimer -->
                                <form action="{{ route('locataires.destroy', $locataire->id) }}" method="POST"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer ce locataire ?')">
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
                                Aucun locataire enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
