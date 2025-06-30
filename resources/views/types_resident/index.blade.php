<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Types de résident</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4 text-accent">Types de résident</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('types-resident.create') }}" class="bg-accent text-white px-4 py-2 rounded mb-4 inline-block">+ Ajouter un type</a>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Libellé</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $type->id }}</td>
                    <td class="px-4 py-2">{{ $type->libelle }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('types-resident.edit', $type->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                        <form action="{{ route('types-resident.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Supprimer ce type ?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
