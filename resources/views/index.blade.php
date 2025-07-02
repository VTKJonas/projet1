<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES LOCATAIRES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        telegramBg: '#F0F2F5',
                        telegramText: '#333333',
                        telegramAccent: '#0088CC',
                        telegramBorder: '#E0E0E0',
                        telegramTableHead: '#EBF5FF',
                        telegramSuccessBg: '#D4EDDA',
                        telegramSuccessText: '#155724',
                        telegramHover: '#F0F0F0',
                        telegramFooterBg: '#E0E7EB',
                        telegramFooterText: '#555555'
                    }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet" />
</head>
<body class="bg-telegramBg min-h-screen text-telegramText flex">

    <!-- SIDEBAR -->
    <aside class="bg-white shadow-lg w-64 flex flex-col p-4 border-r border-telegramBorder">
        <div class="flex items-center space-x-3 mb-8">
            <i class="ti ti-building-store text-telegramAccent text-2xl"></i>
            <span class="text-xl font-bold text-telegramAccent">Gestion App</span>
        </div>
        <nav class="flex flex-col space-y-2">
            <!-- Liens pour les visiteurs -->
            <span class="text-sm font-semibold text-gray-500 uppercase mt-4 mb-2">Visiteurs</span>
            <a href="{{ url('/visites/create') }}" class="text-telegramText hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-telegramHover transition duration-150">
                <i class="ti ti-user-plus"></i><span>Ajouter visiteur</span>
            </a>
            <a href="{{ url('/visites/liste') }}" class="text-telegramText hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-telegramHover transition duration-150">
                <i class="ti ti-users"></i><span>Liste visiteurs</span>
            </a>
            <a href="{{ route('dates.visite') }}" class="text-telegramText hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-telegramHover transition duration-150">
                <i class="ti ti-calendar"></i><span>Dates des visites</span>
            </a>

            <!-- Liens pour les locataires -->
            <span class="text-sm font-semibold text-gray-500 uppercase mt-4 mb-2">Locataires</span>
            <a href="{{ url('/locataires') }}" class="text-telegramText hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-telegramHover transition duration-150">
                <i class="ti ti-users-group"></i><span>Liste locataires</span>
            </a>
            <a href="{{ url('/locataires/create') }}" class="text-telegramText hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-telegramHover transition duration-150">
                <i class="ti ti-user-cog"></i><span>Ajouter locataire</span>
            </a>
            <a href="{{ url('/types-resident') }}" class="text-telegramText hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-telegramHover transition duration-150">
                <i class="ti ti-building-warehouse"></i><span>Types de résident</span>
            </a>

            <!-- Déconnexion -->
            <div class="mt-auto pt-4 border-t border-telegramBorder">
                <a href="{{ url('/logout') }}" class="text-red-600 hover:text-red-800 font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-red-50 transition duration-150">
                    <i class="ti ti-logout"></i><span>Déconnexion</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col justify-between">
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
                                <td colspan="6" class="text-center py-4 text-gray-500 italic">
                                    Aucun locataire enregistré.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-10 py-6 text-center bg-telegramFooterBg text-telegramFooterText rounded-lg shadow-inner">
            <p class="mb-4">&copy; {{ date('Y') }} Gestion App. Tous droits réservés.</p>
            <div class="flex justify-center space-x-6 text-2xl">
                <a href="#" class="hover:text-telegramAccent transition duration-150" aria-label="Facebook">
                    <i class="ti ti-brand-facebook"></i>
                </a>
                <a href="#" class="hover:text-telegramAccent transition duration-150" aria-label="Twitter">
                    <i class="ti ti-brand-twitter"></i>
                </a>
                <a href="#" class="hover:text-telegramAccent transition duration-150" aria-label="Instagram">
                    <i class="ti ti-brand-instagram"></i>
                </a>
                <a href="#" class="hover:text-telegramAccent transition duration-150" aria-label="LinkedIn">
                    <i class="ti ti-brand-linkedin"></i>
                </a>
            </div>
        </footer>
    </div>

</body>
</html>
