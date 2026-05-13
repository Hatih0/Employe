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
            <h5 class="mb-0">Détails de la Demande de Congé</h5>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9"><?= esc($conge['id']) ?></dd>

                <dt class="col-sm-3">Employé:</dt>
                <dd class="col-sm-9">
                    <a href="/employes/<?= $employe['id'] ?>">
                        <?= esc($employe['prenom'] . ' ' . $employe['nom']) ?>
                    </a>
                </dd>

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

                <dt class="col-sm-3">Type de Congé:</dt>
                <dd class="col-sm-9"><?= esc($typeConge['jours_annuels'] ?? '-') ?> jours</dd>

                <dt class="col-sm-3">Dates:</dt>
                <dd class="col-sm-9"><?= esc($conge['date_debut']) ?> au <?= esc($conge['date_fin']) ?></dd>

                <dt class="col-sm-3">Nombre de Jours:</dt>
                <dd class="col-sm-9"><?= esc($conge['nb_jours']) ?> jours</dd>

                <dt class="col-sm-3">Motif:</dt>
                <dd class="col-sm-9"><?= esc($conge['motif'] ?? '-') ?></dd>

                <dt class="col-sm-3">Statut:</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-<?= $conge['statut'] === 'approuve' ? 'success' : ($conge['statut'] === 'refuse' ? 'danger' : 'warning') ?>">
                        <?= ucfirst(esc($conge['statut'])) ?>
                    </span>
                </dd>

                <?php if ($conge['commentaire_rh']): ?>
                    <dt class="col-sm-3">Commentaire RH:</dt>
                    <dd class="col-sm-9"><?= esc($conge['commentaire_rh']) ?></dd>
                <?php endif; ?>
            </dl>
        </div>
    </div>

    <div class="mt-4">
        <a href="/conges" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>

<?php $this->endSection(); ?>
