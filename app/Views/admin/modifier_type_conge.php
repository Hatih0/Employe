<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="form-section">
    <h3>Modifier un type de congé</h3>
    <form method="POST" action="/admin/types-conge/<?= $typeConge['id'] ?>/sauvegarder">
        <div class="form-grid-2">
            <div class="f-group"><label class="f-label">Libellé *</label><input class="f-input" name="libelle" type="text" value="<?= old('libelle', esc($typeConge['libelle'])) ?>" required></div>
            <div class="f-group"><label class="f-label">Jours annuels *</label><input class="f-input" name="jours_annuels" type="number" min="1" value="<?= old('jours_annuels', esc($typeConge['jours_annuels'])) ?>" required></div>
            <div class="f-group"><label class="f-label">Déductible *</label><select class="f-select" name="deductible"><option value="1" <?= old('deductible', $typeConge['deductible']) == '1' ? 'selected' : '' ?>>Oui</option><option value="0" <?= old('deductible', $typeConge['deductible']) == '0' ? 'selected' : '' ?>>Non</option></select></div>
        </div>
        <div class="form-actions"><button class="btn-forest" type="submit">Enregistrer</button><a href="/admin/types-conge" class="btn-secondary">Annuler</a></div>
    </form>
</div>

<?php $this->endSection(); ?>
