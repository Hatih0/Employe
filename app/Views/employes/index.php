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
            <a href="/employes/create" class="btn btn-primary">+ Ajouter un employé</a>
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
            <h5 class="mb-0">Liste des employés</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($employes)): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employes as $emp): ?>
                            <tr>
                                <td><?= esc($emp['id']) ?></td>
                                <td><?= esc($emp['nom']) ?></td>
                                <td><?= esc($emp['prenom']) ?></td>
                                <td><?= esc($emp['email']) ?></td>
                                <td><?= esc($emp['role']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $emp['actif'] ? 'success' : 'danger' ?>">
                                        <?= $emp['actif'] ? 'Actif' : 'Inactif' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/employes/<?= $emp['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                    <a href="/employes/<?= $emp['id'] ?>/edit" class="btn btn-sm btn-warning">Éditer</a>
                                    <form action="/employes/<?= $emp['id'] ?>/delete" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun employé trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
