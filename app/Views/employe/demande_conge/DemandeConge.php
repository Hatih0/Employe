<?php $this->extend('layouts/base'); $this->section('content'); ?>

<div class="form-section">
    <h3>Nouvelle demande de congé</h3>
    <form action="/envoyerDemande" method="post">
        <div class="form-grid-2">
            <div class="f-group">
                <label for="TypeConge" class="f-label">Type de congé *</label>
                <select id="TypeConge" name="TypeConge" class="f-select" required>
                    <option value="">Sélectionnez un type</option>
                    <?php foreach ($allTypesConge as $typeConge): ?>
                        <option value="<?= esc($typeConge['id']) ?>"><?= esc($typeConge['libelle']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="f-group">
                <label for="start_date" class="f-label">Date de début *</label>
                <input type="date" id="start_date" name="start_date" class="f-input" required>
            </div>
            <div class="f-group">
                <label for="end_date" class="f-label">Date de fin *</label>
                <input type="date" id="end_date" name="end_date" class="f-input" required>
            </div>
            <div class="f-group">
                <label for="motif" class="f-label">Motif</label>
                <textarea name="motif" id="motif" class="f-textarea" placeholder="Précisez le motif si nécessaire"></textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-forest">Demander le congé</button>
            <a href="/dashboard" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php $this->endSection(); ?>