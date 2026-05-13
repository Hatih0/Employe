<?php $session = session(); $this->extend('layouts/base'); $this->section('content'); ?>

<?php if ($session->getFlashdata('success')): ?><div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> <?= $session->getFlashdata('success') ?></div><?php endif; ?>
<?php if ($session->getFlashdata('error')): ?><div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= $session->getFlashdata('error') ?></div><?php endif; ?>

<div class="data-card">
    <div class="data-card-head">
        <h3>Gestion des demandes de congé</h3>
    </div>
    <div style="padding:1rem 1.25rem">
        <?php if (empty($demandes)): ?>
            <div class="flash flash-info">Aucune demande en attente de validation.</div>
        <?php else: ?>
            <div class="grid-2">
                <?php foreach ($demandes as $demande): ?>
                    <div class="data-card" style="margin:0">
                        <div class="data-card-head" style="border-bottom:1px solid rgba(15,23,42,.08)">
                            <h3><?= esc($demande['prenom']) ?> <?= esc($demande['nom']) ?></h3>
                            <span class="statut s-attente">En attente</span>
                        </div>
                        <div style="padding:1rem 1.25rem">
                            <div class="form-note" style="margin-bottom:.75rem"><?= esc($demande['email']) ?></div>
                            <div class="metrics" style="grid-template-columns:repeat(2,minmax(0,1fr)); margin-bottom:1rem">
                                <div class="metric"><div class="metric-label">Type</div><div class="metric-value" style="font-size:1.05rem"><?= esc($demande['type_conge']) ?></div></div>
                                <div class="metric"><div class="metric-label">Durée</div><div class="metric-value" style="font-size:1.05rem"><?= esc($demande['nb_jours']) ?> j</div></div>
                            </div>
                            <div class="form-note" style="margin-bottom:.5rem">Du <?= esc($demande['date_debut']) ?> au <?= esc($demande['date_fin']) ?></div>
                            <div class="form-note" style="margin-bottom:1rem">Motif: <?= esc($demande['motif'] ?? '-') ?></div>

                            <div class="action-btns">
                                <button type="button" class="btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#approuverModal<?= $demande['id'] ?>">Approuver</button>
                                <button type="button" class="btn-sm btn-del" data-bs-toggle="modal" data-bs-target="#refuserModal<?= $demande['id'] ?>">Refuser</button>
                            </div>
                        </div>

                        <div class="modal fade" id="approuverModal<?= $demande['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Approuver la demande</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="/rh/demandes/<?= $demande['id'] ?>/approuver">
                                        <div class="modal-body">
                                            <div class="f-group">
                                                <label class="f-label">Commentaire (optionnel)</label>
                                                <textarea class="f-input" name="commentaire" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn-forest">Approuver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="refuserModal<?= $demande['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Refuser la demande</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="/rh/demandes/<?= $demande['id'] ?>/refuser">
                                        <div class="modal-body">
                                            <div class="f-group">
                                                <label class="f-label">Motif du refus *</label>
                                                <textarea class="f-input" name="commentaire" rows="4" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn-forest" style="background:#b91c1c">Refuser</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="form-actions" style="margin-top:1rem">
    <a href="/dashboard" class="btn-secondary">Retour</a>
</div>

<?php $this->endSection(); ?>
