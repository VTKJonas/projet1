<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un locataire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex items-center justify-center py-10">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md relative border border-green-300">

        <!-- Bouton retour -->
        <a href="{{ url()->previous() }}"
           class="absolute top-4 left-4 text-green-600 hover:text-green-800 text-sm font-semibold flex items-center">
            ← Retour
        </a>

        <h2 class="text-2xl font-bold text-center text-green-800 mb-6">Ajouter un locataire</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-900 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('locataires.store') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-medium mb-1">Nom</label>
                <input type="text" name="nom" id="nom" required
                       class="w-full px-3 py-2 bg-white border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block text-gray-700 font-medium mb-1">Prénom</label>
                <input type="text" name="prenom" id="prenom" required
                       class="w-full px-3 py-2 bg-white border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 font-medium mb-1">Téléphone</label>
                <input type="text" name="telephone" id="telephone" required
                       class="w-full px-3 py-2 bg-white border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Bâtiment -->
            <div class="mb-6">
                <label for="batiment" class="block text-gray-700 font-medium mb-1">Bâtiment</label>
                <select name="batiment" id="batiment" required
                        class="w-full px-3 py-2 bg-white border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Sélectionnez un étage --</option>
                    <option value="1er étage">1er étage</option>
                    <option value="2ème étage">2ème étage</option>
                    <option value="3ème étage">3ème étage</option>
                </select>
            </div>

            <!-- Bouton d'envoi -->
            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-200">
                Enregistrer
            </button>
        </form>
    </div>

</body>
</html>
