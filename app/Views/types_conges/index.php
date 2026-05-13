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
            <a href="/types-conges/create" class="btn btn-primary">+ Ajouter un type de congé</a>
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
            <h5 class="mb-0">Liste des types de congés</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($typeConges)): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jours Annuels</th>
                            <th>Déductible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($typeConges as $type): ?>
                            <tr>
                                <td><?= esc($type['id']) ?></td>
                                <td><?= esc($type['jours_annuels']) ?> jours</td>
                                <td>
                                    <span class="badge bg-<?= $type['deductible'] ? 'success' : 'warning' ?>">
                                        <?= $type['deductible'] ? 'Oui' : 'Non' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/types-conges/<?= $type['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                    <a href="/types-conges/<?= $type['id'] ?>/edit" class="btn btn-sm btn-warning">Éditer</a>
                                    <form action="/types-conges/<?= $type['id'] ?>/delete" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun type de congé trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
