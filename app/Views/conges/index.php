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
            <a href="/conges/create" class="btn btn-primary">+ Demander un congé</a>
            <a href="/conges/en-attente" class="btn btn-warning">En Attente</a>
            <a href="/conges/soldes" class="btn btn-info">Soldes</a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liste des demandes de congés</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($conges)): ?>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employé</th>
                            <th>Département</th>
                            <th>Date Début</th>
                            <th>Date Fin</th>
                            <th>Jours</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conges as $conge): ?>
                            <tr>
                                <td><?= esc($conge['id']) ?></td>
                                <td><?= esc($conge['prenom'] . ' ' . $conge['nom']) ?></td>
                                <td><?= esc($conge['departement_nom'] ?? '-') ?></td>
                                <td><?= esc($conge['date_debut']) ?></td>
                                <td><?= esc($conge['date_fin']) ?></td>
                                <td><?= esc($conge['nb_jours']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $conge['statut'] === 'approuve' ? 'success' : ($conge['statut'] === 'refuse' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst(esc($conge['statut'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/conges/<?= $conge['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune demande de congé trouvée.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
