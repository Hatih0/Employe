<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="/envoyerDemande" method="post">

        <label for="TypeConge">Type de congé:</label>
        <select id="TypeConge" name="TypeConge" required>
            <option value="">Sélectionnez un type</option>
            <?php foreach ($allTypesConge as $typeConge): ?>
                <option value="<?= $typeConge['id'] ?>"><?= $typeConge['libelle'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="start_date">Date de début:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">Date de fin:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <label for="motif"> Motif </label>
        <textarea name="motif" id=""></textarea>

        <button type="submit">Demander le congé</button>

    </form>

</body>
</html>