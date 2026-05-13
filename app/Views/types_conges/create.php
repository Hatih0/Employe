<?php
$this->extend('layouts/base');
$this->section('content');
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1><?= esc($title) ?></h1>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="/types-conges/store" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="libelle" class="form-label">Libellé *</label>
                    <input type="text" class="form-control" id="libelle" name="libelle"
                           value="<?= old('libelle') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="jours_annuels" class="form-label">Nombre de jours annuels *</label>
                    <input type="number" class="form-control" id="jours_annuels" name="jours_annuels" 
                           value="<?= old('jours_annuels') ?>" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="deductible" class="form-label">Déductible</label>
                    <select class="form-control" id="deductible" name="deductible">
                        <option value="1" <?= old('deductible', '1') == '1' ? 'selected' : '' ?>>Oui</option>
                        <option value="0" <?= old('deductible') == '0' ? 'selected' : '' ?>>Non</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Créer le type de congé</button>
                    <a href="/types-conges" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
