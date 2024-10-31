<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Registar uma conta</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/register.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/menu.css">
</head>
<body>
    <?php require("templates/menu.php"); ?>
    <h1>Crie uma conta</h1>
    <p>Se já tiver uma conta, <a href="<?= ROOT ?>/login/">faça o login</a></p>

    <?php if (isset($message)) { ?>
        <p role="alert"><?= $message ?></p>
    <?php } ?>

    <form method="POST" action="<?= ROOT ?>/register/">
        <div>
            <label>
                Nome
                <input type="text" name="name" required minlength="3" maxlength="60">
            </label>
        </div>
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
            <label>
                Password Confirm
                <input type="password" name="password_confirm" required minlength="8" maxlength="1000">
            </label>
        </div>
        <div>
            <label>
                Morada
                <input type="text" name="street_address" required minlength="8" maxlength="120">
            </label>
        </div>
        <div>
            <label>
                Cidade
                <input type="text" name="city" required minlength="3" maxlength="50">
            </label>
        </div>
        <div>
            <label>
                Codigo Postal
                <input type="text" name="postal_code" required minlength="4" maxlength="20">
            </label>
        </div>
        <div>
            <label>
                Estado
                <input type="text" name="state" required minlength="3" maxlength="50">
            </label>
        </div>
        <div>
            <label>
                Telefone
                <input type="text" name="phone" required minlength="9" maxlength="30">
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="agrees" required>
                Concorda com nossos termos?
            </label>
        </div>
        <div>
            <button type="submit" name="send">Criar</button>
        </div>
    </form>
</body>
</html>