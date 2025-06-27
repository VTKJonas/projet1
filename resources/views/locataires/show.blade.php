<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du locataire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-800 min-h-screen flex items-center justify-center py-10">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-green-300">
        <h2 class="text-2xl font-bold text-center text-green-800 mb-6">Détails du locataire</h2>

        <div class="space-y-4 text-gray-700">

            <!-- Nom -->
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-3.315 0-6 2.239-6 5h12c0-2.761-2.685-5-6-5z"/>
                </svg>
                <p><strong>Nom :</strong> {{ $locataire->nom }}</p>
            </div>

            <!-- Prénom -->
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-3.315 0-6 2.239-6 5h12c0-2.761-2.685-5-6-5z"/>
                </svg>
                <p><strong>Prénom :</strong> {{ $locataire->prenom }}</p>
            </div>

            <!-- Téléphone -->
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3l2 4-2 2H5v6h2l2 2-2 4H5a2 2 0 01-2-2V5z"/>
                </svg>
                <p><strong>Téléphone :</strong> {{ $locataire->telephone }}</p>
            </div>

            <!-- Bâtiment -->
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M10 2a1 1 0 01.894.553l7 14A1 1 0 0117 18H3a1 1 0 01-.894-1.447l7-14A1 1 0 0110 2zM9 12a1 1 0 112 0v4a1 1 0 11-2 0v-4z"
                          clip-rule="evenodd" />
                </svg>
                <p><strong>Bâtiment :</strong> {{ $locataire->batiment }}</p>
            </div>
        </div>

        <!-- Bouton pour ajouter un autre locataire -->
        <a href="{{ route('locataires.create') }}"
           class="mt-6 block text-center bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-200">
            Ajouter un autre locataire
        </a>

        <!-- Bouton pour supprimer ce locataire -->
        <form action="{{ route('locataires.destroy', $locataire->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce locataire ?')"
                    class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition duration-200">
                Supprimer ce locataire
            </button>
        </form>
    </div>

</body>
</html>
