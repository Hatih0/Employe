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
            <form action="/conges/store" method="POST">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employe_id" class="form-label">Employé *</label>
                            <select class="form-control" id="employe_id" name="employe_id" required>
                                <option value="">-- Sélectionner un employé --</option>
                                <?php foreach ($employes as $emp): ?>
                                    <option value="<?= $emp['id'] ?>" <?= old('employe_id') == $emp['id'] ? 'selected' : '' ?>>
                                        <?= esc($emp['prenom'] . ' ' . $emp['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type_conge_id" class="form-label">Type de Congé *</label>
                            <select class="form-control" id="type_conge_id" name="type_conge_id" required>
                                <option value="">-- Sélectionner un type --</option>
                                <?php foreach ($typeConges as $type): ?>
                                    <option value="<?= $type['id'] ?>" <?= old('type_conge_id') == $type['id'] ? 'selected' : '' ?>>
                                        <?= esc($type['jours_annuels'] . ' jours') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de Début *</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" 
                                   value="<?= old('date_debut') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de Fin *</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" 
                                   value="<?= old('date_fin') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="motif" class="form-label">Motif</label>
                    <textarea class="form-control" id="motif" name="motif" rows="3"><?= old('motif') ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Soumettre la demande</button>
                    <a href="/conges" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
