<?php $this->extend('layouts/base'); $this->section('content'); ?>

<div class="data-card">
    <div class="data-card-head">
        <h3>Mes demandes de congé</h3>
        <a href="/demanderConge" class="btn-forest"><i class="bi bi-plus-lg"></i> Nouvelle demande</a>
    </div>
    <table class="tbl">
        <thead>
            <tr>
                <th>Type de congé</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Motif</th>
                <th>Statut</th>
                <th>Commentaire RH</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($demandes as $demande): ?>
                <tr>
                    <td class="td-name"><?= esc($demande['type_conge']) ?></td>
                    <td class="td-muted"><?= esc($demande['date_debut']) ?></td>
                    <td class="td-muted"><?= esc($demande['date_fin']) ?></td>
                    <td class="td-muted"><?= esc($demande['motif'] ?? '-') ?></td>
                    <td><span class="statut <?= $demande['statut'] === 'en_attente' ? 's-attente' : ($demande['statut'] === 'approuvée' ? 's-approuvee' : ($demande['statut'] === 'refusée' ? 's-refusee' : 's-annulee')) ?>"><?= esc($demande['statut']) ?></span></td>
                    <td class="td-muted"><?= esc($demande['commentaire_rh'] ?? '-') ?></td>
                    <td>
                        <?php if ($demande['statut'] === 'en_attente'): ?>
                            <form action="/supprimerDemande/<?= esc($demande['id']) ?>" method="get" style="display:inline;">
                                <button type="submit" class="btn-sm btn-cancel">Annuler</button>
                            </form>
                        <?php else: ?>
                            <span class="td-muted">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>