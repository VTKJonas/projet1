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
                        cafe: '#f5f0eb',
                        accent: '#3B82F6',
                        grisclair: '#f9f9f9',
                        bordure: '#ddd',
                        texte: '#333333'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cafe min-h-screen flex items-center justify-center px-4 py-10 text-texte">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-6xl p-8 border border-bordure">
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
                   class="w-full max-w-md px-3 py-2 border border-bordure bg-white rounded-l-md focus:outline-none focus:ring focus:ring-accent">
            <button type="submit"
                    class="bg-accent text-white px-4 py-2 rounded-r-md hover:bg-blue-600">
                Rechercher
            </button>
        </form>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full text-sm text-left border border-bordure bg-white">
                <thead class="bg-accent text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 border-b border-bordure">Photo</th>
                        <th class="px-6 py-3 border-b border-bordure">Nom</th>
                        <th class="px-6 py-3 border-b border-bordure">Prénom</th>
                        <th class="px-6 py-3 border-b border-bordure">Date</th>
                        <th class="px-6 py-3 border-b border-bordure">Heure d'arrivée</th>
                        <th class="px-6 py-3 border-b border-bordure">Motif</th>
                        <th class="px-6 py-3 text-center border-b border-bordure">Statut</th>
                    </tr>
                </thead>
                <tbody class="text-texte">
                    @forelse($visiteurs as $visiteur)
                        <tr class="hover:bg-grisclair transition">
                            <td class="px-6 py-4 border-b border-bordure">
                                @if($visiteur->photo)
                                    <img src="{{ asset('storage/' . $visiteur->photo) }}"
                                         alt="Photo"
                                         class="w-12 h-12 object-cover rounded-full border border-bordure">
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b border-bordure">{{ $visiteur->nom }}</td>
                            <td class="px-6 py-4 border-b border-bordure">{{ $visiteur->prenom }}</td>
                            <td class="px-6 py-4 border-b border-bordure">{{ $visiteur->date }}</td>
                            <td class="px-6 py-4 border-b border-bordure">{{ $visiteur->heure_arrivee }}</td>
                            <td class="px-6 py-4 border-b border-bordure">{{ $visiteur->motif }}</td>
                            <td class="px-6 py-4 text-center border-b border-bordure">
                                <span class="text-yellow-600 font-semibold">En attente</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 italic">
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
