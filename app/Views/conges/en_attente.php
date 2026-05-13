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
        <div class="card-header bg-warning">
            <h5 class="mb-0">Demandes en Attente d'Approbation</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($conges)): ?>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employé</th>
                            <th>Département</th>
                            <th>Dates</th>
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
                                <td><?= esc($conge['departement']['nom'] ?? '-') ?></td>
                                <td><?= esc($conge['date_debut'] . ' au ' . $conge['date_fin']) ?></td>
                                <td><?= esc($conge['nb_jours']) ?></td>
                                <td><?= esc(substr($conge['motif'] ?? '-', 0, 30)) ?></td>
                                <td>
                                    <a href="/conges/<?= $conge['id'] ?>" class="btn btn-sm btn-info">Détails</a>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approuverModal<?= $conge['id'] ?>">Approuver</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#refuserModal<?= $conge['id'] ?>">Refuser</button>
                                </td>
                            </tr>

                            <!-- Modal Approuver -->
                            <div class="modal fade" id="approuverModal<?= $conge['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Approuver la Demande</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="/conges/<?= $conge['id'] ?>/approuver" method="POST">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="commentaire" class="form-label">Commentaire RH</label>
                                                    <textarea class="form-control" name="commentaire" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-success">Approuver</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Refuser -->
                            <div class="modal fade" id="refuserModal<?= $conge['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Refuser la Demande</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="/conges/<?= $conge['id'] ?>/refuser" method="POST">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="commentaire" class="form-label">Raison du Refus *</label>
                                                    <textarea class="form-control" name="commentaire" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-danger">Refuser</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-success">Aucune demande en attente.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
