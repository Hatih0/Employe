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
            <h5 class="mb-0">Détails du département</h5>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9"><?= esc($departement['id']) ?></dd>

                <dt class="col-sm-3">Nom:</dt>
                <dd class="col-sm-9"><?= esc($departement['nom']) ?></dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9"><?= esc($departement['description'] ?? '-') ?></dd>
            </dl>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Données en JSON</h5>
        </div>
        <div class="card-body">
            <pre><code><?= json_encode($departement, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></code></pre>
        </div>
    </div>

    <div class="mt-4">
        <a href="/departements" class="btn btn-secondary">Retour à la liste</a>
        <a href="/departements/<?= $departement['id'] ?>/edit" class="btn btn-warning">Éditer</a>
        <form action="/departements/<?= $departement['id'] ?>/delete" method="POST" style="display:inline;">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>
