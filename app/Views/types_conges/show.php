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
            <h5 class="mb-0">Détails du type de congé</h5>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9"><?= esc($typeConge['id']) ?></dd>

                <dt class="col-sm-3">Jours Annuels:</dt>
                <dd class="col-sm-9"><?= esc($typeConge['jours_annuels']) ?> jours</dd>

                <dt class="col-sm-3">Déductible:</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-<?= $typeConge['deductible'] ? 'success' : 'warning' ?>">
                        <?= $typeConge['deductible'] ? 'Oui' : 'Non' ?>
                    </span>
                </dd>
            </dl>
        </div>
    </div>

    <div class="mt-4">
        <a href="/types-conges" class="btn btn-secondary">Retour à la liste</a>
        <a href="/types-conges/<?= $typeConge['id'] ?>/edit" class="btn btn-warning">Éditer</a>
        <form action="/types-conges/<?= $typeConge['id'] ?>/delete" method="POST" style="display:inline;">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>
