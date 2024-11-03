<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Pedidos</title>
    <link rel="stylesheet" href="/css/orders.css">
    <link rel="stylesheet" href="/css/backoffice_menu.css">
</head>
<body>
    <?php require("views/templates/backoffice_menu.php"); ?>
    <div class="orders-container">
        <h1>Gestão de Pedidos</h1>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>ID do Pedido</th>
                    <th>ID do Usuário</th>
                    <th>Data do Pedido</th>
                    <th>Nome do Comprador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['user_id']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= htmlspecialchars($order['buyer_name']) ?></td>
                        <td>
                            <a href="/admin/order_details/<?= $order['order_id'] ?>" class="btn detail-btn">Ver Detalhes</a>
                            <a href="/admin/edit_order/<?= $order['order_id'] ?>" class="btn manage-btn">Gerenciar Pedido</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>