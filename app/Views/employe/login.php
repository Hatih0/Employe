<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Employés</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
            color: white;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="/authenticate" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= isset($firstEmploye['email']) ? esc($firstEmploye['email']) : 'user@example.com' ?>" 
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" 
                       value="<?= isset($firstEmploye['password']) ? esc($firstEmploye['password']) : 'user123' ?>" 
                       required>
            </div>

            <button type="submit" class="btn btn-login">Se connecter</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>