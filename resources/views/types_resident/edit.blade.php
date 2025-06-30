<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le type</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-accent">Modifier le type de résident</h1>

        <form action="{{ route('types-resident.update', $type->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Libellé</label>
                <input type="text" name="libelle" value="{{ $type->libelle }}" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-accent text-white px-4 py-2 rounded hover:bg-blue-700">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</body>
</html>
