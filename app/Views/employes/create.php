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
            <form action="/employes/store" method="POST">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="nom" name="nom" 
                                   value="<?= old('nom') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom *</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" 
                                   value="<?= old('prenom') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= old('email') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <input type="text" class="form-control" id="role" name="role" 
                                   value="<?= old('role', 'Employé') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="departement_id" class="form-label">Département</label>
                            <select class="form-control" id="departement_id" name="departement_id">
                                <option value="">-- Sélectionner un département --</option>
                                <?php foreach ($departements as $dept): ?>
                                    <option value="<?= $dept['id'] ?>" <?= old('departement_id') == $dept['id'] ? 'selected' : '' ?>>
                                        <?= esc($dept['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_embauche" class="form-label">Date d'embauche</label>
                            <input type="date" class="form-control" id="date_embauche" name="date_embauche" 
                                   value="<?= old('date_embauche') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="actif" class="form-label">Statut</label>
                            <select class="form-control" id="actif" name="actif">
                                <option value="1" <?= old('actif', '1') == '1' ? 'selected' : '' ?>>Actif</option>
                                <option value="0" <?= old('actif') == '0' ? 'selected' : '' ?>>Inactif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Créer l'employé</button>
                    <a href="/employes" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
