<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('success')): ?><div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> <?= $session->getFlashdata('success') ?></div><?php endif; ?>
<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="form-actions" style="margin-top:0"><a href="/admin/types-conge/creer" class="btn-forest"><i class="bi bi-plus-lg"></i> Ajouter un type de congé</a><a href="/admin/dashboard" class="btn-secondary">Retour</a></div>

<div class="data-card">
    <div class="data-card-head"><h3>Types de congé</h3></div>
    <table class="tbl">
        <thead><tr><th>ID</th><th>Libellé</th><th>Jours annuels</th><th>Déductible</th><th>Actions</th></tr></thead>
        <tbody>
        <?php if (!empty($types)): foreach ($types as $type): ?>
            <tr>
                <td><?= esc($type['id']) ?></td>
                <td class="td-name"><?= esc($type['libelle']) ?></td>
                <td><?= esc($type['jours_annuels']) ?> jours</td>
                <td><span class="badge <?= $type['deductible'] == '1' ? 'bg-success' : 'bg-warning' ?>"><?= $type['deductible'] == '1' ? 'Oui' : 'Non' ?></span></td>
                <td>
                    <div class="action-btns">
                        <a href="/admin/types-conge/<?= $type['id'] ?>/modifier" class="btn-sm btn-edit">Modifier</a>
                        <button type="button" class="btn-sm btn-del" data-bs-toggle="modal" data-bs-target="#deleteTypeCongeModal<?= $type['id'] ?>">Supprimer</button>
                    </div>
                    <div class="modal fade" id="deleteTypeCongeModal<?= $type['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Confirmer la suppression</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">Supprimer <strong><?= esc($type['libelle']) ?></strong> ?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button><form method="POST" action="/admin/types-conge/<?= $type['id'] ?>/supprimer"><button type="submit" class="btn btn-danger">Supprimer</button></form></div></div></div>
                    </div>
                </td>
            </tr>
        <?php endforeach; else: ?>
            <tr><td colspan="5" class="text-center td-muted">Aucun type de congé disponible.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>
