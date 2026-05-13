<?php $this->extend('layouts/base'); $this->section('content'); ?>

<div class="page-head">
    <div>
        <h1><?= esc($title) ?></h1>
        <p>Vue d'ensemble des soldes pour l'année <?= esc($annee) ?></p>
    </div>
    <div class="form-actions" style="margin-top:0">
        <a href="/dashboard" class="btn-secondary">Retour</a>
    </div>
</div>

<div class="metrics">
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-people"></i></div></div>
        <div class="metric-label">Employés suivis</div>
        <div class="metric-value"><?= count($employes) ?></div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-blue"><i class="bi bi-calendar-check"></i></div></div>
        <div class="metric-label">Total attribué</div>
        <div class="metric-value"><?= array_sum(array_map(static fn(array $row) => (int) $row['total_attribues'], $soldesParEmploye)) ?></div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-calendar-minus"></i></div></div>
        <div class="metric-label">Total pris</div>
        <div class="metric-value"><?= array_sum(array_map(static fn(array $row) => (int) $row['total_pris'], $soldesParEmploye)) ?></div>
    </div>
</div>

<div class="data-card" style="margin-top:1.25rem">
    <div class="data-card-head">
        <h3>Détails par employé</h3>
    </div>
    <table class="tbl">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Attribués</th>
                <th>Pris</th>
                <th>Restants</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe): ?>
                <?php $resume = $soldesParEmploye[$employe['id']] ?? ['total_attribues' => 0, 'total_pris' => 0, 'total_restants' => 0]; ?>
                <tr>
                    <td class="td-name"><?= esc($employe['prenom'] . ' ' . $employe['nom']) ?></td>
                    <td><?= esc($resume['total_attribues']) ?></td>
                    <td><?= esc($resume['total_pris']) ?></td>
                    <td><strong><?= esc($resume['total_restants']) ?></strong></td>
                    <td>
                        <div class="action-btns">
                            <a href="/conges/solde/<?= $employe['id'] ?>" class="btn-sm btn-edit">Voir détail</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>