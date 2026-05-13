<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table>

        <tr>
            <th>Type de congé</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Motif</th>
            <th>Statut</th>
            <th>Commentaire RH</th>
            <th>Action</th>
        </tr>

        <?php foreach ($demandes as $demande): ?>
            <tr>
                <td><?= htmlspecialchars($demande['type_conge']) ?></td>
                <td><?= htmlspecialchars($demande['date_debut']) ?></td>
                <td><?= htmlspecialchars($demande['date_fin']) ?></td>
                <td><?= htmlspecialchars($demande['motif'] ?? '-') ?></td>
                <td><?= htmlspecialchars($demande['statut']) ?></td>
                <td><?= htmlspecialchars($demande['commentaire_rh'] ?? '-') ?></td>
                <?php if ($demande['statut'] === 'en_attente'): ?>
                <td>
                    <a href="/supprimerDemande/<?= $demande['id'] ?>">Annuler</a>
                </td>
                <?php else: ?>
                <td>
                    -
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>