<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="form-section">
    <h3>Modifier l'employé</h3>
    <form method="POST" action="/admin/employes/<?= $employe['id'] ?>/sauvegarder">
        <div class="form-grid-2">
            <div class="f-group"><label class="f-label">Nom *</label><input class="f-input" name="nom" type="text" value="<?= old('nom', esc($employe['nom'])) ?>" required></div>
            <div class="f-group"><label class="f-label">Prénom *</label><input class="f-input" name="prenom" type="text" value="<?= old('prenom', esc($employe['prenom'])) ?>" required></div>
            <div class="f-group"><label class="f-label">Email *</label><input class="f-input" name="email" type="email" value="<?= old('email', esc($employe['email'])) ?>" required></div>
            <div class="f-group"><label class="f-label">Rôle *</label><select class="f-select" name="role" required><option value="employe" <?= old('role', $employe['role']) === 'employe' ? 'selected' : '' ?>>Employé</option><option value="rh" <?= old('role', $employe['role']) === 'rh' ? 'selected' : '' ?>>Responsable RH</option><option value="admin" <?= old('role', $employe['role']) === 'admin' ? 'selected' : '' ?>>Administrateur</option></select></div>
        </div>
        <div class="form-actions"><button class="btn-forest" type="submit">Enregistrer</button><a href="/admin/employes" class="btn-secondary">Annuler</a></div>
    </form>
</div>

<?php $this->endSection(); ?>
