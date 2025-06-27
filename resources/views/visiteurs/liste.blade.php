<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Visiteurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cafe: '#d7ccc8',         // Fond café doux
                        accent: '#3B82F6',       // Bleu vif
                        blackish: '#191414',     // Fond sombre
                        slate: '#1e1e1e',        // Table sombre
                        lightgray: '#B3B3B3',    // Texte gris clair
                        rowhover: '#2e2e2e'      // Hover sombre doux
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cafe min-h-screen flex items-center justify-center px-4 py-10 text-black">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-6xl p-8 border border-gray-300">
        <h2 class="text-3xl font-bold text-center text-accent mb-6">Liste des visiteurs</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 font-medium px-4 py-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('visiteurs.liste') }}" class="mb-6 flex justify-center">
            <input type="text" name="search" placeholder="Rechercher un visiteur..."
                   value="{{ request('search') }}"
                   class="w-full max-w-md px-3 py-2 border border-gray-400 text-black bg-white rounded-l-md focus:outline-none focus:ring focus:ring-accent">
            <button type="submit"
                    class="bg-accent text-white px-4 py-2 rounded-r-md hover:bg-blue-600">
                Rechercher
            </button>
        </form>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-accent text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Prénom</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Heure d'arrivée</th>
                        <th class="px-6 py-3">Motif</th>
                        <th class="px-6 py-3 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-slate text-white divide-y divide-gray-600">
                    @forelse($visiteurs as $visiteur)
                        <tr class="hover:bg-rowhover transition">
                            <td class="px-6 py-4">{{ $visiteur->nom }}</td>
                            <td class="px-6 py-4">{{ $visiteur->prenom }}</td>
                            <td class="px-6 py-4">{{ $visiteur->date }}</td>
                            <td class="px-6 py-4">{{ $visiteur->heure_arrivee }}</td>
                            <td class="px-6 py-4">{{ $visiteur->motif }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-yellow-400 font-semibold">En attente</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-lightgray italic">
                                Aucun visiteur enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
