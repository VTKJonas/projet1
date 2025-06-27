<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>AJOUT DES LOCATAIRES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cafe: '#d7ccc8', // fond doux couleur café
                        accent: '#3B82F6',
                        champ: '#f5f5f5',
                        bordure: '#9e9e9e'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cafe min-h-screen flex items-center justify-center py-10 text-gray-800">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-8 border border-bordure relative">

        <!-- Bouton retour -->
        <a href="{{ url()->previous() }}"
           class="absolute top-4 left-4 text-accent hover:text-blue-600 text-sm font-semibold flex items-center">
            ← Retour
        </a>

        <h2 class="text-2xl font-bold text-center text-accent mb-6">Ajouter un locataire</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-900 px-4 py-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('locataires.store') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="nom" id="nom" required
                       class="w-full px-3 py-2 bg-champ border border-bordure rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium mb-1">Prénom</label>
                <input type="text" name="prenom" id="prenom" required
                       class="w-full px-3 py-2 bg-champ border border-bordure rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium mb-1">Téléphone</label>
                <input type="text" name="telephone" id="telephone" required
                       class="w-full px-3 py-2 bg-champ border border-bordure rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
            </div>

            <!-- Bâtiment -->
            <div class="mb-6">
                <label for="batiment" class="block text-sm font-medium mb-1">Bâtiment</label>
                <select name="batiment" id="batiment" required
                        class="w-full px-3 py-2 bg-champ border border-bordure rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
                    <option value="">-- Sélectionnez un étage --</option>
                    <option value="1er étage">1er étage</option>
                    <option value="2ème étage">2ème étage</option>
                    <option value="3ème étage">3ème étage</option>
                </select>
            </div>

            <!-- Bouton -->
            <button type="submit"
                    class="w-full bg-accent text-white py-2 rounded-md hover:bg-blue-700 transition duration-200 mb-4">
                Enregistrer le locataire
            </button>
        </form>

        @if(session('locataire_id'))
            <a href="{{ route('locataires.show', session('locataire_id')) }}"
               class="block text-center bg-accent text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                Consulter la fiche du locataire
            </a>
        @endif

    </div>

</body>
</html>
