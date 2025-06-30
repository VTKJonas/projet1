<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dates des visites</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Dates des Visites</h1>

    @if($datesVisites->isEmpty())
        <p class="text-center text-red-500">Aucune visite enregistrée pour l’instant.</p>
    @else
        <ul class="max-w-md mx-auto bg-white rounded-xl shadow-md p-6">
            @foreach($datesVisites as $visite)
                <li class="border-b border-gray-300 py-2">{{ $visite->date }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
