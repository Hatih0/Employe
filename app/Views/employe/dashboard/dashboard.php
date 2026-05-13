<?php
$this->extend('layouts/base');
$this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Tableau de Bord</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Départements</h5>
                <p class="card-text">Gérer les départements</p>
                <a href="/departements" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Employés</h5>
                <p class="card-text">Gérer les employés</p>
                <a href="/employes" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Types de Congés</h5>
                <p class="card-text">Gérer les types de congés</p>
                <a href="/types-conges" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Demandes de Congés</h5>
                <p class="card-text">Gérer les demandes de congés</p>
                <a href="/conges" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Demandes en Attente</h5>
                <p class="card-text">Approuver/Refuser les demandes</p>
                <a href="/conges/en-attente" class="btn btn-warning">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Soldes de Congés</h5>
                <p class="card-text">Consulter les soldes</p>
                <a href="/conges/soldes" class="btn btn-info">Accéder</a>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
