<?php
$this->extend('layouts/base');
$this->section('content');
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1><?= esc($title) ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Détails de l'employé</h5>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9"><?= esc($employe['id']) ?></dd>

                <dt class="col-sm-3">Nom:</dt>
                <dd class="col-sm-9"><?= esc($employe['nom']) ?></dd>

                <dt class="col-sm-3">Prénom:</dt>
                <dd class="col-sm-9"><?= esc($employe['prenom']) ?></dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9"><?= esc($employe['email']) ?></dd>

                <dt class="col-sm-3">Rôle:</dt>
                <dd class="col-sm-9"><?= esc($employe['role'] ?? '-') ?></dd>

                <dt class="col-sm-3">Département:</dt>
                <dd class="col-sm-9">
                    <?php if ($departement): ?>
                        <a href="/departements/<?= $departement['id'] ?>">
                            <?= esc($departement['nom']) ?>
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </dd>

                <dt class="col-sm-3">Date d'embauche:</dt>
                <dd class="col-sm-9"><?= esc($employe['date_embauche'] ?? '-') ?></dd>

                <dt class="col-sm-3">Statut:</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-<?= $employe['actif'] ? 'success' : 'danger' ?>">
                        <?= $employe['actif'] ? 'Actif' : 'Inactif' ?>
                    </span>
                </dd>
            </dl>
        </div>
    </div>

    <div class="mt-4">
        <a href="/employes" class="btn btn-secondary">Retour à la liste</a>
        <a href="/employes/<?= $employe['id'] ?>/edit" class="btn btn-warning">Éditer</a>
        <form action="/employes/<?= $employe['id'] ?>/delete" method="POST" style="display:inline;">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>
