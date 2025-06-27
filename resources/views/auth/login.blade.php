<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>CONNEXION</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cafe: '#3E2F2F',
                        cafeLight: '#5b4646',
                        accent: '#3B82F6'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cafe min-h-screen flex items-center justify-center text-white">

    <div class="bg-cafeLight rounded-2xl shadow-xl p-10 w-full max-w-sm border border-gray-600">
        <h1 class="text-2xl font-bold text-center text-white mb-6">Connexion</h1>

        @if ($errors->any())
            <div class="bg-red-600 bg-opacity-20 border border-red-400 text-red-300 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-1">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 rounded-md bg-white text-black border border-gray-400 focus:outline-none focus:ring-2 focus:ring-accent">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-1">Mot de passe :</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 rounded-md bg-white text-black border border-gray-400 focus:outline-none focus:ring-2 focus:ring-accent">
            </div>

            <button type="submit"
                    class="w-full bg-accent text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                Connexion
            </button>
        </form>
    </div>

</body>
</html>
