<!DOCTYPE html>
<html>
<head>
    <title>Informations Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            border-top: 5px solid #3498db;
        }
        .form-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .btn-submit {
            background-color: #2ecc71;
            border-color: #2ecc71;
            width: 100%;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }
        .form-control[readonly] {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body style="background-color: #e9ecef;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h1 class="form-title">Informations Complémentaires</h1>
                    
                    <form method="POST" action="{{ route('userinfo.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $nom }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label fw-bold">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $prenom }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label fw-bold">Téléphone</label>
                            <input type="tel" class="form-control" id="tel" name="tel" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="form-text">Minimum 8 caractères</div>
                        </div>
                        <button type="submit" class="btn btn-success btn-submit">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>