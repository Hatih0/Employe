<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? esc($title) . ' - ' : '' ?>TechMada RH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet" />
    <style>
        :root{
            --ink:#1c2b1e;
            --forest:#2d5a3d;
            --forest2:#3d7a52;
            --leaf:#5fa876;
            --mint:#d4ede0;
            --cream:#f8f6f1;
            --white:#ffffff;
            --border:#dde8e1;
            --muted:#7a8f80;
            --danger:#c0392b;
            --danger-bg:#fdf0ee;
            --danger-br:#f0b8b2;
            --warn:#b8750a;
            --warn-bg:#fef9ee;
            --warn-br:#f5d98a;
            --success:#1e6b3f;
            --success-bg:#edf7f2;
            --success-br:#8fd4aa;
            --info:#1a4f7a;
            --info-bg:#eaf2fb;
            --info-br:#8fbde8;
            --sidebar-w:240px;
            --topbar-h:62px;
        }
        *{box-sizing:border-box}
        body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--ink);margin:0;font-size:15px}
        h1,h2,h3,.brand-name{font-family:'Playfair Display',serif}
        .geo-bg{position:relative;overflow:hidden}
        .geo-bg::before{content:'';position:absolute;inset:0;background-image:repeating-linear-gradient(0deg,transparent,transparent 39px,rgba(45,90,61,.04) 40px),repeating-linear-gradient(90deg,transparent,transparent 39px,rgba(45,90,61,.04) 40px);pointer-events:none;z-index:0}
        .geo-bg>*{position:relative;z-index:1}
        .app-wrap{display:flex;min-height:100vh}
        .sidebar{width:var(--sidebar-w);background:var(--ink);display:flex;flex-direction:column;flex-shrink:0;position:sticky;top:0;height:100vh;overflow-y:auto}
        .sidebar-brand{padding:1.4rem 1.2rem 1rem;display:flex;align-items:center;gap:10px;border-bottom:1px solid rgba(255,255,255,.06)}
        .sidebar-logo-icon{width:34px;height:34px;background:var(--forest);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .sidebar-logo-icon i{color:var(--white);font-size:1.1rem}
        .sidebar-brand-name{font-family:'Playfair Display',serif;font-size:1rem;color:var(--white);line-height:1.2}
        .sidebar-brand-name span{display:block;font-size:.65rem;font-family:'DM Sans',sans-serif;font-weight:400;color:rgba(255,255,255,.35);letter-spacing:.05em;text-transform:uppercase}
        .sidebar-section{padding:.75rem 1.1rem .3rem;font-size:.62rem;font-weight:500;letter-spacing:1.4px;text-transform:uppercase;color:rgba(255,255,255,.25);margin-top:.25rem}
        .sidebar-nav{list-style:none;padding:0 .75rem;margin:0}
        .sidebar-nav li{margin-bottom:2px}
        .sidebar-nav li a{display:flex;align-items:center;gap:9px;padding:9px 11px;border-radius:7px;color:rgba(255,255,255,.55);text-decoration:none;font-size:.85rem;font-weight:400;transition:all .15s}
        .sidebar-nav li a:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.9)}
        .sidebar-nav li a.active{background:var(--forest);color:var(--white)}
        .sidebar-nav li a i{font-size:1.05rem;flex-shrink:0}
        .nav-badge{margin-left:auto;font-size:.65rem;padding:2px 7px;border-radius:10px;background:rgba(255,255,255,.12);color:var(--white)}
        .nav-badge.alert{background:var(--danger);color:var(--white)}
        .sidebar-user{padding:.85rem .75rem;border-top:1px solid rgba(255,255,255,.06);margin-top:auto}
        .s-user-row{display:flex;align-items:center;gap:9px;padding:9px 11px;border-radius:7px;cursor:pointer;transition:background .15s}
        .s-user-row:hover{background:rgba(255,255,255,.06)}
        .avatar{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:500;color:var(--white);flex-shrink:0;font-family:'DM Mono',monospace}
        .av-green{background:var(--forest2)}
        .av-blue{background:#1a4f7a}
        .av-amber{background:#b8750a}
        .user-name{font-size:.825rem;font-weight:500;color:var(--white);line-height:1.2}
        .user-role{font-size:.65rem;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:.06em}
        .main{flex:1;min-width:0;display:flex;flex-direction:column}
        .topbar{height:var(--topbar-h);background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 1.75rem;gap:1rem;position:sticky;top:0;z-index:10}
        .topbar-title{font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:600;color:var(--ink)}
        .topbar-breadcrumb{font-size:.78rem;color:var(--muted);display:flex;align-items:center;gap:5px}
        .topbar-actions{margin-left:auto;display:flex;align-items:center;gap:8px}
        .content{padding:1.75rem;flex:1}
        .btn-forest{background:var(--forest);color:var(--white);border:none;border-radius:8px;padding:9px 16px;font-size:.85rem;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:6px;text-decoration:none;transition:background .15s}
        .btn-forest:hover{background:var(--forest2);color:var(--white)}
        .btn-secondary{background:var(--white);color:var(--muted);border:1.5px solid var(--border);border-radius:8px;padding:9px 16px;font-size:.85rem;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:6px;text-decoration:none;transition:all .15s}
        .btn-secondary:hover{border-color:var(--muted);color:var(--ink)}
        .btn-sm{font-size:.72rem;font-weight:500;padding:5px 10px;border-radius:6px;border:1px solid transparent;cursor:pointer;transition:all .15s;text-decoration:none;display:inline-flex;align-items:center;gap:4px;font-family:'DM Sans',sans-serif}
        .btn-edit{background:var(--info-bg);color:var(--info);border-color:var(--info-br)}
        .btn-edit:hover{background:#d5e8f7}
        .btn-del{background:var(--cream);color:var(--muted);border-color:var(--border)}
        .btn-del:hover{background:var(--danger-bg);color:var(--danger);border-color:var(--danger-br)}
        .btn-view{background:var(--cream);color:var(--muted);border-color:var(--border)}
        .btn-view:hover{background:var(--mint);color:var(--forest);border-color:var(--forest)}
        .btn-cancel{background:var(--cream);color:var(--muted);border-color:var(--border)}
        .btn-cancel:hover{background:var(--danger-bg);color:var(--danger)}
        .flash{padding:11px 14px;border-radius:8px;font-size:.85rem;font-weight:500;display:flex;align-items:center;gap:9px;margin-bottom:1.25rem;border:1px solid transparent}
        .flash-success{background:var(--success-bg);color:var(--success);border-color:var(--success-br)}
        .flash-error{background:var(--danger-bg);color:var(--danger);border-color:var(--danger-br)}
        .flash-warn{background:var(--warn-bg);color:var(--warn);border-color:var(--warn-br)}
        .flash-info{background:var(--info-bg);color:var(--info);border-color:var(--info-br)}
        .data-card,.form-section{background:var(--white);border:1px solid var(--border);border-radius:12px;overflow:hidden;margin-bottom:1.5rem}
        .data-card-head{padding:.9rem 1.25rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap}
        .data-card-head h3,.form-section h3{font-family:'Playfair Display',serif;font-size:.95rem;margin:0;font-weight:600;color:var(--ink)}
        .form-section{padding:1.5rem}
        .tbl{width:100%;border-collapse:collapse;font-size:.85rem}
        .tbl thead th{padding:9px 14px;font-size:.68rem;font-weight:500;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);background:var(--cream);border-bottom:1px solid var(--border);text-align:left;white-space:nowrap}
        .tbl tbody tr{border-bottom:1px solid var(--border);transition:background .1s}
        .tbl tbody tr:last-child{border-bottom:none}
        .tbl tbody tr:hover{background:var(--cream)}
        .tbl td{padding:12px 14px;color:var(--ink);vertical-align:middle}
        .td-muted{color:var(--muted)}
        .td-mono{font-family:'DM Mono',monospace;font-size:.8rem}
        .type-badge{display:inline-block;font-size:.68rem;font-weight:500;padding:3px 8px;border-radius:4px}
        .t-annuel{background:var(--mint);color:var(--forest)}
        .t-maladie{background:var(--info-bg);color:var(--info)}
        .t-special{background:#f0e8fb;color:#5a2d82}
        .t-sans-solde{background:#f1efe8;color:#7a8f80}
        .statut{display:inline-flex;align-items:center;gap:5px;font-size:.7rem;font-weight:500;padding:4px 9px;border-radius:12px}
        .statut::before{content:'';width:5px;height:5px;border-radius:50%;display:inline-block;flex-shrink:0}
        .s-attente{background:var(--warn-bg);color:var(--warn)}
        .s-attente::before{background:var(--warn)}
        .s-approuvee{background:var(--success-bg);color:var(--success)}
        .s-approuvee::before{background:var(--success)}
        .s-refusee{background:var(--danger-bg);color:var(--danger)}
        .s-refusee::before{background:var(--danger)}
        .s-annulee{background:#f1efe8;color:#7a8f80}
        .s-annulee::before{background:#b4b2a9}
        .action-btns{display:flex;gap:5px;flex-wrap:wrap}
        .footer-app{padding:.75rem 1.75rem;border-top:1px solid var(--border);font-size:.75rem;color:var(--muted);background:var(--white);display:flex;align-items:center;gap:6px}
        .footer-app span{color:var(--forest);font-weight:500}
        .f-group{margin-bottom:1rem}
        .f-label{font-size:.8rem;font-weight:500;color:var(--ink);margin-bottom:5px;display:block}
        .f-input,.f-select,.f-textarea{width:100%;border:1.5px solid var(--border);border-radius:8px;padding:10px 12px;font-size:.875rem;font-family:'DM Sans',sans-serif;background:var(--white);color:var(--ink)}
        .f-input:focus,.f-select:focus,.f-textarea:focus{border-color:var(--forest);outline:none;box-shadow:0 0 0 3px rgba(45,90,61,.1)}
        .f-select{cursor:pointer}
        .f-textarea{resize:vertical;min-height:80px}
        .form-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:1.25rem}
        .profile-row{display:flex;align-items:center;gap:12px}
        .profile-row .avatar{width:44px;height:44px;font-size:.8rem}
        .profile-info .pname{font-weight:500;font-size:.9rem;color:var(--ink)}
        .profile-info .pdept{font-size:.75rem;color:var(--muted)}
        @media (max-width: 992px){
            .app-wrap{flex-direction:column}
            .sidebar{width:100%;height:auto;position:relative}
        }
        @media (max-width: 768px){
            .topbar{padding:0 1rem;flex-wrap:wrap;height:auto;min-height:var(--topbar-h)}
            .content{padding:1rem}
        }
    </style>
</head>
<body>
<?php
$session = session();
$role = strtolower((string) $session->get('role'));
$userInitials = strtoupper(substr((string) $session->get('prenom'), 0, 1) . substr((string) $session->get('nom'), 0, 1));
$currentPath = trim(service('uri')->getPath(), '/');

$menu = [];
if ($role === 'admin') {
    $menu = [
        ['label' => 'Vue d\'ensemble', 'href' => '/admin/dashboard', 'icon' => 'bi-speedometer2'],
        ['label' => 'Employés', 'href' => '/admin/employes', 'icon' => 'bi-people'],
        ['label' => 'Types de congé', 'href' => '/admin/types-conge', 'icon' => 'bi-tags'],
        ['label' => 'Absences', 'href' => '/admin/absences', 'icon' => 'bi-calendar2-week'],
    ];
} elseif ($role === 'rh') {
    $menu = [
        ['label' => 'Demandes', 'href' => '/rh/demandes', 'icon' => 'bi-inbox'],
        ['label' => 'Soldes', 'href' => '/rh/soldes', 'icon' => 'bi-people'],
    ];
} else {
    $menu = [
        ['label' => 'Tableau de bord', 'href' => '/dashboard', 'icon' => 'bi-grid-1x2'],
        ['label' => 'Nouvelle demande', 'href' => '/demanderConge', 'icon' => 'bi-plus-circle'],
        ['label' => 'Mes demandes', 'href' => '/MesDemandes', 'icon' => 'bi-calendar3'],
        ['label' => 'Mon profil', 'href' => '/profil', 'icon' => 'bi-person'],
    ];
}
?>
<div class="app-wrap geo-bg">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-logo-icon"><i class="bi bi-briefcase"></i></div>
            <div class="sidebar-brand-name">TechMada RH<span><?= esc($role === 'admin' ? 'Administration' : ($role === 'rh' ? 'Espace responsable' : 'Espace employé')) ?></span></div>
        </div>
        <div class="sidebar-section">Menu</div>
        <ul class="sidebar-nav">
            <?php foreach ($menu as $item): ?>
                <?php $isActive = $currentPath === trim($item['href'], '/') || str_starts_with($currentPath, trim($item['href'], '/')); ?>
                <li>
                    <a href="<?= esc($item['href']) ?>" class="<?= $isActive ? 'active' : '' ?>"><i class="bi <?= esc($item['icon']) ?>"></i> <?= esc($item['label']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="sidebar-user">
            <div class="s-user-row">
                <div class="avatar av-green"><?= esc($userInitials !== '' ? $userInitials : 'TM') ?></div>
                <div>
                    <div class="user-name"><?= esc(trim((string) $session->get('prenom') . ' ' . (string) $session->get('nom'))) ?: 'Utilisateur' ?></div>
                    <div class="user-role"><?= esc($role ?: 'invité') ?></div>
                </div>
            </div>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title"><?= isset($title) ? esc($title) : 'TechMada RH' ?></div>
                <div class="topbar-breadcrumb">Gestion des congés</div>
            </div>
            <div class="topbar-actions">
                <a href="/logout" class="btn-forest"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
            </div>
        </div>

        <div class="content">
            <?= $this->renderSection('content') ?>
        </div>

        <div class="footer-app"><i class="bi bi-c-circle"></i> <?= date('Y') ?> <span>TechMada RH</span></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
