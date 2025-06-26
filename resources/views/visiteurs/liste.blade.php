<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des visiteurs</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-sky-200 min-h-screen flex items-center justify-center px-4 py-10">




    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl p-8">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Liste des visiteurs</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 font-medium px-4 py-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg">
                           <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('visiteurs.liste') }}" class="mb-6 flex justify-center">
                        <input type="text" name="search" placeholder="Rechercher un visiteur..."
                            value="{{ request('search') }}"
                            class="w-full max-w-md px-2 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:ring-blue-400">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">
                            Rechercher
                        </button>
                    </form>
            <table class="min-w-full text-sm text-left text-gray-700">
                        
                <thead class="bg-blue-600 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Prénom</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Heure d'arrivée</th>
                        <th class="px-6 py-3">Motif</th>
                        <th class="px-6 py-3 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($visiteurs as $visiteur)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">{{ $visiteur->nom }}</td>
                            <td class="px-6 py-4">{{ $visiteur->prenom }}</td>
                            <td class="px-6 py-4">{{ $visiteur->date }}</td>
                            <td class="px-6 py-4">{{ $visiteur->heure_arrivee }}</td>
                            <td class="px-6 py-4">{{ $visiteur->motif }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-600 font-semibold">En attente</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Aucun visiteur enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

 

</body>
</html>
