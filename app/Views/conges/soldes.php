<?php
$this->extend('layouts/base');
$this->section('content');
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1><?= esc($title) ?></h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/conges" class="btn btn-secondary">Retour</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Soldes de Congés - <?= esc($annee) ?></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th>Jours Attribués</th>
                            <th>Jours Pris</th>
                            <th>Jours Restants</th>
                            <th>Utilisation</th>
                            <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employes as $employe): ?>
                            <?php 
                            $soldesEmp = $soldesParEmploye[$employe['id']] ?? [];
                            $totalAttribues = 0;
                            $totalPris = 0;
                            foreach ($soldesEmp as $solde) {
                                $totalAttribues += $solde['jours_attribues'];
                                $totalPris += $solde['jours_pris'];
                            }
                            ?>
                            <tr>
                                <td>
                                    <a href="/employes/<?= $employe['id'] ?>">
                                        <?= esc($employe['prenom'] . ' ' . $employe['nom']) ?>
                                    </a>
                                </td>
                                <td><?= esc($totalAttribues) ?></td>
                                <td><?= esc($totalPris) ?></td>
                                <td><strong><?= esc($totalAttribues - $totalPris) ?></strong></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <?php 
                                        $pourcent = $totalAttribues > 0 ? ($totalPris / $totalAttribues) * 100 : 0;
                                        $couleur = $pourcent < 50 ? 'bg-success' : ($pourcent < 80 ? 'bg-warning' : 'bg-danger');
                                        ?>
                                        <div class="progress-bar <?= $couleur ?>" style="width: <?= $pourcent ?>%">
                                            <?= round($pourcent, 0) ?>%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/conges/solde/<?= $employe['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
