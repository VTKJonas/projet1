<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle demande de visite</title>
</head>
<body>
    <h2>Bonjour {{ $locataire->name }},</h2>
    <p>Le visiteur {{ $visiteur->nom }} {{ $visiteur->prenom }} souhaite vous rendre visite le {{ $visiteur->date }} à {{ $visiteur->heure_arrivee }}.</p>
    <p>Motif : {{ $visiteur->motif }}</p>

    <p>Voulez-vous accepter cette visite ?</p>

    <a href="{{ route('visite.response', ['id' => $visiteur->id, 'response' => 'accept']) }}"
       style="display:inline-block;padding:10px 20px;background-color:green;color:white;text-decoration:none;margin-right:10px;">
       Oui, j’accepte
    </a>

    <a href="{{ route('visite.response', ['id' => $visiteur->id, 'response' => 'refuse']) }}"
       style="display:inline-block;padding:10px 20px;background-color:red;color:white;text-decoration:none;">
       Non, je refuse
    </a>

    <p>Merci.</p>
</body>
</html>
