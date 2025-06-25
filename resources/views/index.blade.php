<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif Visiteur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Informations du Visiteur</h2>

        <table class="table table-bordered">
            <tr>
                <th>Nom</th>
                <td>{{ $visiteur->nom }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $visiteur->prenom }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $visiteur->date }}</td>
            </tr>
            <tr>
                <th>Heure d'arrivée</th>
                <td>{{ $visiteur->heure_arrivee }}</td>
            </tr>
            <tr>
                <th>Heure de départ</th>
                <td>{{ $visiteur->heure_depart }}</td>
            </tr>
            <tr>
                <th>Motif</th>
                <td>{{ $visiteur->motif }}</td>
            </tr>
        </table>

        <a href="{{ route('visiteur.create') }}" class="btn btn-primary">Ajouter un autre visiteur</a>
    </div>
</body>
</html>
