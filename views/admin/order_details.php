<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pedido #<?php echo $order['order_id']; ?></title>
    <link rel="stylesheet" href="/css/order_details.css"> 
    <link rel="stylesheet" href="/css/backoffice_menu.css">
</head>
<body>
    <?php require('views/templates/backoffice_menu.php'); ?>
    <div class="container">
        <h1>Detalhes do Pedido #<?php echo $order['order_id']; ?></h1>

        <div class="order-info">
            <h2>Informações do Pedido</h2>
            <p><strong>Cliente:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['customer_email']); ?></p>
            <p><strong>Data do Pedido:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
            <p><strong>Status do Pedido:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
        </div>

        <div class="order-items">
            <h2>Itens do Pedido</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order['products'] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>R$ <?php echo number_format($item['price_each'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($item['total'], 2, ',', '.'); ?></td> 
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total do Pedido:</strong> R$ <?php echo number_format(isset($order['total']) ? $order['total'] : 0, 2, ',', '.'); ?></p>
        </div>

        <div class="actions">
            <a href="/admin/edit_order/<?= $order['order_id'] ?>" class="button">Gerenciar Pedido</a>
            <a href="/admin/orders" class="button">Voltar para Pedidos</a>
        </div>
    </div>
</body>
</html>