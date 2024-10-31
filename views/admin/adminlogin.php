<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/login.css">
</head>
<body>

    <h1>Login de Administrador</h1>
    <p>Apenas Administradores.</p>

    <?php if (isset($message)) : ?>
        <p style="color: red;"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" action="<?= ROOT ?>/admin/login">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="send">Entrar</button>
    </form>

</body>
</html>