<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('success')): ?><div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> <?= $session->getFlashdata('success') ?></div><?php endif; ?>
<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="data-card">
    <div class="data-card-head"><h3>Mon profil</h3></div>
    <div style="padding:1rem 1.25rem">
        <div class="metrics" style="margin-bottom:1rem">
            <div class="metric"><div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-person"></i></div></div><div class="metric-label"><?= esc($employe['prenom'] ?? $session->get('prenom')) ?> <?= esc($employe['nom'] ?? $session->get('nom')) ?></div></div>
            <div class="metric"><div class="metric-top"><div class="metric-icon mi-blue"><i class="bi bi-envelope"></i></div></div><div class="metric-label"><?= esc($employe['email'] ?? $session->get('email')) ?></div></div>
            <div class="metric"><div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-briefcase"></i></div></div><div class="metric-label"><?= esc($employe['role'] ?? $session->get('role')) ?></div></div>
        </div>

        <div class="form-section" style="margin:0;padding:1rem">
            <h3>Informations personnelles</h3>
            <form method="POST" action="/profil/modifier">
                <div class="form-grid-2">
                    <div class="f-group"><label class="f-label">Nom</label><input class="f-input" name="nom" type="text" value="<?= esc($employe['nom'] ?? '') ?>" required></div>
                    <div class="f-group"><label class="f-label">Prénom</label><input class="f-input" name="prenom" type="text" value="<?= esc($employe['prenom'] ?? '') ?>" required></div>
                    <div class="f-group"><label class="f-label">Email</label><input class="f-input" name="email" type="email" value="<?= esc($employe['email'] ?? '') ?>" required></div>
                </div>
                <div class="form-actions"><button class="btn-forest" type="submit">Enregistrer</button><a class="btn-secondary" href="/dashboard">Retour</a></div>
            </form>
        </div>
     </div>
 </div>

<?php $this->endSection(); ?>
