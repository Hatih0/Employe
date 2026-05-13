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

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Soldes de Congés - <?= esc($annee) ?></h5>
        </div>
        <div class="card-body">
            <h6>Employé: <?= esc($employe['prenom'] . ' ' . $employe['nom']) ?></h6>
            <hr>
            
            <?php if (!empty($soldes)): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Type de Congé</th>
                            <th>Jours Attribués</th>
                            <th>Jours Pris</th>
                            <th>Jours Restants</th>
                            <th>Taux d'Utilisation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($soldes as $solde): ?>
                            <tr>
                                <td><?= esc($solde['type_conge']['jours_annuels'] ?? '-') ?> jours</td>
                                <td><?= esc($solde['jours_attribues']) ?></td>
                                <td><?= esc($solde['jours_pris']) ?></td>
                                <td>
                                    <strong><?= esc($solde['jours_restants']) ?></strong>
                                </td>
                                <td>
                                    <div class="progress">
                                        <?php 
                                        $pourcent = ($solde['jours_pris'] / $solde['jours_attribues']) * 100;
                                        $couleur = $pourcent < 50 ? 'bg-success' : ($pourcent < 80 ? 'bg-warning' : 'bg-danger');
                                        ?>
                                        <div class="progress-bar <?= $couleur ?>" style="width: <?= $pourcent ?>%">
                                            <?= round($pourcent, 0) ?>%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun solde de congé trouvé pour cet employé.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-4">
        <a href="/conges/soldes" class="btn btn-secondary">Retour aux soldes</a>
    </div>
</div>

<?php $this->endSection(); ?>
