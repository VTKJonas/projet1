<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 20px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            margin-top: 25px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            background-color: #ffe6e6;
            color: #d8000c;
            padding: 10px;
            margin-top: 15px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Connexion</h1>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            

            <label for="email">Email :</label>
            <input type="email" name="email" id="email"  value="{{ old('email') }}" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Connexion</button>
        </form>

    </div>
</body>
</html>
