<!DOCTYPE html>
<html>
<head>
    <title>Formulaire Visiteur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .form-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .btn-custom {
            background-color: #3498db;
            border-color: #3498db;
            width: 100%;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
    </style>
</head>
<body style="background-color: #e9ecef;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h1 class="form-title">Formulaire Visiteur</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('visiteur.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label fw-bold">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="heure_arrivee" class="form-label fw-bold">Heure d'arrivée</label>
                                <input type="time" class="form-control" id="heure_arrivee" name="heure_arrivee" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="heure_depart" class="form-label fw-bold">Heure de départ</label>
                                <input type="time" class="form-control" id="heure_depart" name="heure_depart" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="motif" class="form-label fw-bold">Motif</label>
                            <input type="text" class="form-control" id="motif" name="motif" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-custom">Suivant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>