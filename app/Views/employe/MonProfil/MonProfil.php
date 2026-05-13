<?php
$session = session();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .info-display {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }

        .info-display p {
            margin-bottom: 10px;
            color: #666;
        }

        .info-display strong {
            color: #333;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }

        button,
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background-color: #5568d3;
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .edit-form {
            display: none;
        }

        .edit-form.active {
            display: block;
        }

        .profile-info.hidden {
            display: none;
        }

        .readonly-field {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Mon Profil</h1>

        <?php if ($session->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= $session->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($session->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= $session->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Affichage des informations (mode lecture) -->
        <div class="profile-info" id="profileInfo">
            <div class="info-display">
                <p><strong>Nom:</strong> <?= htmlspecialchars($employe['nom']) ?></p>
            </div>
            <div class="info-display">
                <p><strong>Prénom:</strong> <?= htmlspecialchars($employe['prenom']) ?></p>
            </div>
            <div class="info-display">
                <p><strong>Email:</strong> <?= htmlspecialchars($employe['email']) ?></p>
            </div>
            <div class="info-display">
                <p><strong>Rôle:</strong> <?= htmlspecialchars($employe['role']) ?></p>
            </div>
            <div class="info-display">
                <p><strong>Date d'embauche:</strong> <?= htmlspecialchars($employe['date_embauche']) ?></p>
            </div>
            <div class="info-display">
                <p><strong>Statut:</strong> <?= $employe['actif'] == '1' ? 'Actif' : 'Inactif' ?></p>
            </div>

            <div class="button-group">
                <button class="btn btn-primary" onclick="toggleEditForm()">Modifier mon profil</button>
                <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary">Retour au tableau de bord</a>
            </div>
        </div>

        <!-- Formulaire de modification -->
        <form method="POST" action="<?= base_url('/profil/modifier') ?>" class="edit-form" id="editForm">
            <?= csrf_field() ?>

            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($employe['nom']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($employe['prenom']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($employe['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Rôle</label>
                <input type="text" id="role" name="role" value="<?= htmlspecialchars($employe['role']) ?>" class="readonly-field" readonly>
            </div>

            <div class="form-group">
                <label for="date_embauche">Date d'embauche</label>
                <input type="date" id="date_embauche" name="date_embauche" value="<?= htmlspecialchars($employe['date_embauche']) ?>" class="readonly-field" readonly>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <button type="button" class="btn btn-secondary" onclick="toggleEditForm()">Annuler</button>
            </div>
        </form>
    </div>

    <script>
        function toggleEditForm() {
            const profileInfo = document.getElementById('profileInfo');
            const editForm = document.getElementById('editForm');

            profileInfo.classList.toggle('hidden');
            editForm.classList.toggle('active');
        }
    </script>
</body>

</html>
