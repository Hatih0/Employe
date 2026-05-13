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
            <a href="/departements/create" class="btn btn-primary">+ Ajouter un département</a>
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
            <h5 class="mb-0">Liste des départements</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($departements)): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departements as $dept): ?>
                            <tr>
                                <td><?= esc($dept['id']) ?></td>
                                <td><?= esc($dept['nom']) ?></td>
                                <td><?= esc($dept['description'] ?? '-') ?></td>
                                <td>
                                    <a href="/departements/<?= $dept['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                    <a href="/departements/<?= $dept['id'] ?>/edit" class="btn btn-sm btn-warning">Éditer</a>
                                    <form action="/departements/<?= $dept['id'] ?>/delete" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun département trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
