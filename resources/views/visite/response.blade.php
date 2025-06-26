<!DOCTYPE html>
<html>
<head>
    <title>Réponse à la visite</title>
</head>
<body>
    @if($response == 'accept')
        <h2>Merci d’avoir accepté la visite !</h2>
    @else
        <h2>Vous avez refusé la visite.</h2>
    @endif
</body>
</html>
