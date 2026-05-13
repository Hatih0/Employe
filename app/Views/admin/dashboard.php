<?php $this->extend('layouts/base'); $this->section('content'); ?>

<div class="metrics">
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-people"></i></div></div>
        <div class="metric-val"><?= esc($totalEmployes) ?></div>
        <div class="metric-label">Employés actifs</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-hourglass-split"></i></div></div>
        <div class="metric-val"><?= esc($totalDemandes) ?></div>
        <div class="metric-label">Demandes totales</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-green"><i class="bi bi-calendar-check"></i></div></div>
        <div class="metric-val"><?= esc($demandesEnAttente) ?></div>
        <div class="metric-label">En attente</div>
    </div>
</div>

<div class="data-card">
    <div class="data-card-head"><h3>Gestion du système</h3></div>
    <div style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem">
        <a class="form-section" href="/admin/employes" style="text-decoration:none;color:inherit;margin:0;padding:1.1rem">
            <h3>Gérer les employés</h3>
            <p class="td-muted mb-0">Créer, modifier ou supprimer des employés.</p>
        </a>
        <a class="form-section" href="/admin/types-conge" style="text-decoration:none;color:inherit;margin:0;padding:1.1rem">
            <h3>Types de congé</h3>
            <p class="td-muted mb-0">Gérer les types de congés disponibles.</p>
        </a>
        <a class="form-section" href="/admin/absences" style="text-decoration:none;color:inherit;margin:0;padding:1.1rem">
            <h3>Historique des absences</h3>
            <p class="td-muted mb-0">Voir toutes les absences approuvées.</p>
        </a>
        <a class="form-section" href="/dashboard" style="text-decoration:none;color:inherit;margin:0;padding:1.1rem">
            <h3>Retour</h3>
            <p class="td-muted mb-0">Revenir au tableau de bord employé.</p>
        </a>
    </div>
</div>

<?php $this->endSection(); ?>