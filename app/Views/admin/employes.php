<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('success')): ?><div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> <?= $session->getFlashdata('success') ?></div><?php endif; ?>
<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="form-actions" style="margin-top:0">
    <a href="/admin/employes/creer" class="btn-forest"><i class="bi bi-person-plus"></i> Ajouter un employé</a>
    <a href="/admin/dashboard" class="btn-secondary">Retour</a>
</div>

<div class="data-card">
    <div class="data-card-head"><h3>Gestion des employés</h3></div>
    <table class="tbl">
        <thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Rôle</th><th>Statut</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($employes as $employe): ?>
            <tr>
                <td><?= esc($employe['id']) ?></td>
                <td class="td-name"><?= esc($employe['nom']) ?></td>
                <td><?= esc($employe['prenom']) ?></td>
                <td class="td-muted"><?= esc($employe['email']) ?></td>
                <td><span class="type-badge t-annuel"><?= esc($employe['role']) ?></span></td>
                <td><span class="statut <?= $employe['actif'] == '1' ? 's-approuvee' : 's-annulee' ?>"><?= $employe['actif'] == '1' ? 'Actif' : 'Inactif' ?></span></td>
                <td>
                    <div class="action-btns">
                        <a href="/admin/employes/<?= $employe['id'] ?>/modifier" class="btn-sm btn-edit">Modifier</a>
                        <button type="button" class="btn-sm btn-del" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $employe['id'] ?>">Supprimer</button>
                    </div>
                    <div class="modal fade" id="deleteModal<?= $employe['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Confirmer la suppression</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">Supprimer cet employé ?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button><form method="POST" action="/admin/employes/<?= $employe['id'] ?>/supprimer"><button type="submit" class="btn btn-danger">Supprimer</button></form></div></div></div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>
