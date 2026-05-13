<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('success')): ?><div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> <?= $session->getFlashdata('success') ?></div><?php endif; ?>
<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<?php $joursAttribues = $solde['jours_attribues'] ?? 0; ?>
<?php $joursPris = $solde['jours_pris'] ?? 0; ?>
<?php $joursRestants = max(0, $joursAttribues - $joursPris); ?>

<div class="metrics">
    <div class="metric">
        <div class="metric-top">
            <div class="metric-icon mi-forest"><i class="bi bi-calendar2-heart"></i></div>
        </div>
        <div class="metric-label">Congés restants</div>
        <div class="metric-value"><?= esc($joursRestants) ?></div>
    </div>
    <div class="metric">
        <div class="metric-top">
            <div class="metric-icon mi-blue"><i class="bi bi-card-checklist"></i></div>
        </div>
        <div class="metric-label">Jours attribués</div>
        <div class="metric-value"><?= esc($joursAttribues) ?></div>
    </div>
    <div class="metric">
        <div class="metric-top">
            <div class="metric-icon mi-amber"><i class="bi bi-clipboard-data"></i></div>
        </div>
        <div class="metric-label">Jours pris</div>
        <div class="metric-value"><?= esc($joursPris) ?></div>
    </div>
</div>

<div class="grid-2" style="margin-top:1.25rem">
    <div class="data-card">
        <div class="data-card-head"><h3>Actions rapides</h3></div>
        <div style="padding:1rem 1.25rem; display:grid; gap:.75rem">
            <a href="/demanderConge" class="btn-forest" style="text-align:center">Demander un congé</a>
            <a href="/MesDemandes" class="btn-secondary" style="text-align:center">Voir mes demandes</a>
            <a href="/profil" class="btn-secondary" style="text-align:center">Mon profil</a>
        </div>
    </div>

    <div class="data-card">
        <div class="data-card-head"><h3>Résumé</h3></div>
        <div style="padding:1rem 1.25rem">
            <p class="td-muted" style="margin-bottom:.75rem">Votre espace employé centralise vos demandes, votre profil et le suivi de vos congés.</p>
            <div class="form-note">Congé restant calculé à partir des jours attribués moins les jours pris.</div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
