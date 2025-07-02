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
                        telegramBg: '#e6f0fa',        // fond bleu très clair
                        telegramPrimary: '#229ED9',   // bleu Telegram
                        telegramDark: '#1c90c6',      // hover / accent plus foncé
                        white: '#ffffff',
                        redSoft: '#fddede'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-telegramBg min-h-screen flex items-center justify-center text-gray-800">

    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-sm border border-gray-200">
        <h1 class="text-2xl font-bold text-center text-telegramPrimary mb-6">Connexion</h1>

        @if ($errors->any())
            <div class="bg-redSoft border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
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
                       class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-telegramPrimary text-gray-900">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-1">Mot de passe :</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-telegramPrimary text-gray-900">
            </div>

            <button type="submit"
                    class="w-full bg-telegramPrimary text-white font-semibold py-2 px-4 rounded-md hover:bg-telegramDark transition duration-200">
                Connexion
            </button>
        </form>
    </div>

</body>
</html>
