<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('success')): ?><div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> <?= $session->getFlashdata('success') ?></div><?php endif; ?>

<div class="form-actions" style="margin-top:0"><a href="/admin/dashboard" class="btn-secondary">Retour</a></div>

<div class="data-card">
    <div class="data-card-head"><h3>Historique des absences</h3></div>
    <table class="tbl">
        <thead><tr><th>Employé</th><th>Type</th><th>Date de début</th><th>Date de fin</th><th>Durée</th><th>Statut</th></tr></thead>
        <tbody>
        <?php if (!empty($absences)): foreach ($absences as $absence): ?>
            <tr>
                <td class="td-name"><?= esc($absence['prenom']) ?> <?= esc($absence['nom']) ?></td>
                <td><span class="type-badge t-maladie"><?= esc($absence['type_conge']) ?></span></td>
                <td class="td-muted"><?= esc($absence['date_debut']) ?></td>
                <td class="td-muted"><?= esc($absence['date_fin']) ?></td>
                <td class="td-mono"><?= esc($absence['nb_jours']) ?> j</td>
                <td><span class="statut s-approuvee">Approuvée</span></td>
            </tr>
        <?php endforeach; else: ?>
            <tr><td colspan="6" class="text-center td-muted">Aucune absence enregistrée.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>

</html>
