<?php
$this->extend('layouts/base');
$this->section('content');
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1><?= esc($title) ?></h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/conges" class="btn btn-secondary">Retour</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Demandes de Congés - <?= ucfirst(esc($statut)) ?></h5>
        </div>
        <div class="card-body">
            <?php if (!empty($conges)): ?>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employé</th>
                            <th>Date Début</th>
                            <th>Date Fin</th>
                            <th>Jours</th>
                            <th>Motif</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conges as $conge): ?>
                            <tr>
                                <td><?= esc($conge['id']) ?></td>
                                <td><?= esc($conge['employe']['prenom'] . ' ' . $conge['employe']['nom']) ?></td>
                                <td><?= esc($conge['date_debut']) ?></td>
                                <td><?= esc($conge['date_fin']) ?></td>
                                <td><?= esc($conge['nb_jours']) ?></td>
                                <td><?= esc(substr($conge['motif'] ?? '-', 0, 30)) ?></td>
                                <td>
                                    <a href="/conges/<?= $conge['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune demande de congé avec ce statut.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
