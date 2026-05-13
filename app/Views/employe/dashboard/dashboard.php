<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> tableau de bord Employée </h1>

    <a href="/demanderConge">Demander un congé</a>
    <a href="/MesDemandes"> Mes demande </a>
    <a href="/profil"> Mon profil </a>

    <p> congee restant : <?= isset($solde['jours_attribues']) ? $solde['jours_attribues'] - $solde['jours_pris'] : 0 ?> </p>

</body>
</html>