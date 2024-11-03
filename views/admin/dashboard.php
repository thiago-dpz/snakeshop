<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="/css/dashboard.css"> 
</head>
<body>

    <div class="container">
        <h1 class="welcome-title">Bem-vindo ao Painel de Administração!</h1>
        <p class="welcome-message">Você está logado como administrador.</p>

        <ul class="admin-menu">
            <li><a href="<?= ROOT ?>/admin/products" class="menu-item">Gerenciar Produtos</a></li>
            <li><a href="<?= ROOT ?>/admin/orders" class="menu-item">Gerenciar Pedidos</a></li>
        </ul>

        <a href="<?= ROOT ?>/logout" class="logout-button">Logout</a>
    </div>

</body>
</html>