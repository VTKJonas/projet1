<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif Visiteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-8">
        <h2 class="text-3xl font-bold text-green-600 text-center mb-6 border-b border-green-300 pb-4">
            🧾 Récapitulatif du Visiteur
        </h2>

        <table class="w-full table-auto border border-green-300 rounded-lg overflow-hidden">
            <tbody>
                <tr class="bg-green-100">
                    <th class="text-left py-3 px-4 font-semibold text-green-800 border-b border-green-200">Nom</th>
                    <td class="py-3 px-4 border-b border-green-200">{{ $visiteur->nom }}</td>
                </tr>
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-green-800 border-b border-green-200">Prénom</th>
                    <td class="py-3 px-4 border-b border-green-200">{{ $visiteur->prenom }}</td>
                </tr>
                <tr class="bg-green-100">
                    <th class="text-left py-3 px-4 font-semibold text-green-800 border-b border-green-200">Date</th>
                    <td class="py-3 px-4 border-b border-green-200">{{ $visiteur->date }}</td>
                </tr>
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-green-800 border-b border-green-200">Heure d'arrivée</th>
                    <td class="py-3 px-4 border-b border-green-200">{{ $visiteur->heure_arrivee }}</td>
                </tr>
                
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-green-800">Motif</th>
                    <td class="py-3 px-4">{{ $visiteur->motif }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 text-center">
            <a href="{{ route('visiteur.create') }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300">
                + Ajouter un autre visiteur
            </a>
        </div>
    </div>
</body>
</html>
