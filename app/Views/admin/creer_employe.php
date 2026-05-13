<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="form-section">
    <h3>Créer un nouvel employé</h3>
    <form method="POST" action="/admin/employes/sauvegarder">
        <div class="form-grid-2">
            <div class="f-group"><label class="f-label">Nom *</label><input class="f-input" name="nom" type="text" value="<?= old('nom') ?>" required></div>
            <div class="f-group"><label class="f-label">Prénom *</label><input class="f-input" name="prenom" type="text" value="<?= old('prenom') ?>" required></div>
            <div class="f-group"><label class="f-label">Email *</label><input class="f-input" name="email" type="email" value="<?= old('email') ?>" required></div>
            <div class="f-group"><label class="f-label">Mot de passe *</label><input class="f-input" name="password" type="password" required></div>
            <div class="f-group"><label class="f-label">Rôle *</label><select class="f-select" name="role" required><option value="">--</option><option value="employe">Employé</option><option value="rh">Responsable RH</option><option value="admin">Administrateur</option></select></div>
        </div>
        <div class="form-actions"><button class="btn-forest" type="submit">Créer</button><a href="/admin/employes" class="btn-secondary">Annuler</a></div>
    </form>
</div>

<?php $this->endSection(); ?>
