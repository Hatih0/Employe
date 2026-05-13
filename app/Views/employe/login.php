<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div style="color: red;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="/authenticate" method="post">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= isset($firstEmploye['email']) ? $firstEmploye['email'] : '' ?>" required><br><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" value="<?= isset($firstEmploye['password']) ? $firstEmploye['password'] : '' ?>" required><br><br>

        <button type="submit">Se connecter</button>

    </form>

</body>
</html>