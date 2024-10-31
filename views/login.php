<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SnakeShop</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/login.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/menu.css">
</head>
<body>
    <?php require("templates/menu.php"); ?>

<?php
    if (isset($message)) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
    <h1>Entrar na sua conta</h1>
    <p>Se ainda não tiver conta, <a href="<?= ROOT ?>/register/">registre-se!</a></p>

    <form method="POST" action="<?= ROOT ?>/login/">
        <div>
            <label>
                Email
                <input type="email" name="email" required>
            </label>
        </div>
        <div>
            <label>
                Password
                <input type="password" name="password" required minlength="8" maxlength="1000">
            </label>
        </div>
        <div>
            <button type="submit" name="send">Login</button>
        </div>
    </form>
</body>
</html>