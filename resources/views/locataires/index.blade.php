<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>LISTE DES LOCATAIRES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blackish: '#191414',
                        accent: '#3B82F6',
                        grayborder: '#4B5563',
                        darktable: '#0f172a',
                        lightgray: '#9ca3af'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-blackish min-h-screen p-10 text-white">

<div class="max-w-5xl mx-auto bg-black rounded-lg shadow-xl p-6 border border-grayborder">

    <h1 class="text-3xl font-bold text-accent mb-6 text-center">Liste des locataires</h1>

    @if(session('success'))
        <div class="bg-green-700 bg-opacity-30 text-green-300 px-4 py-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('locataires.create') }}"
       class="mb-6 inline-block bg-accent text-black px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
        Ajouter un locataire
    </a>

    <div class="overflow-x-auto rounded">
        <table class="w-full table-auto border-collapse border border-grayborder">
            <thead>
                <tr class="bg-darktable text-accent">
                    <th class="border border-grayborder px-4 py-2 text-left">Nom</th>
                    <th class="border border-grayborder px-4 py-2 text-left">Prénom</th>
                    <th class="border border-grayborder px-4 py-2 text-left">Téléphone</th>
                    <th class="border border-grayborder px-4 py-2 text-left">Bâtiment</th>
                    <th class="border border-grayborder px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locataires as $locataire)
                    <tr class="hover:bg-darktable transition">
                        <td class="border border-grayborder px-4 py-2">{{ $locataire->nom }}</td>
                        <td class="border border-grayborder px-4 py-2">{{ $locataire->prenom }}</td>
                        <td class="border border-grayborder px-4 py-2">{{ $locataire->telephone }}</td>
                        <td class="border border-grayborder px-4 py-2">{{ $locataire->batiment }}</td>
                        <td class="border border-grayborder px-4 py-2 flex gap-2">
                            <!-- Voir -->
                            <a href="{{ route('locataires.show', $locataire->id) }}"
                               class="bg-accent text-black px-3 py-1 rounded hover:bg-blue-600 text-sm transition">
                                Voir
                            </a>

                            <!-- Supprimer -->
                            <form action="{{ route('locataires.destroy', $locataire->id) }}" method="POST"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce locataire ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm transition">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-lightgray italic">
                            Aucun locataire enregistré.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
