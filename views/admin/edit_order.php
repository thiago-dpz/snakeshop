<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedido</title>
    <link rel="stylesheet" href="/css/edit_order.css"> <!-- Link para o seu CSS -->
    <link rel="stylesheet" href="/css/backoffice_menu.css">
</head>
<body>
    <?php require('views/templates/backoffice_menu.php'); ?>
    <div class="container">
        <h1>Gerenciar Pedido #<?= htmlspecialchars($order['order_id']) ?></h1>

        <form method="POST">
            <label for="status">Status do Pedido:</label>
            <input type="text" name="status" id="status" value="<?= htmlspecialchars($order['status']) ?>" required>
            
            <label for="payment_date">Data de Pagamento:</label>
            <input type="date" name="payment_date" id="payment_date" value="<?= htmlspecialchars($order['payment_date']) ?>">

            <label for="shipping_date">Data de Envio:</label>
            <input type="date" name="shipping_date" id="shipping_date" value="<?= htmlspecialchars($order['shipping_date']) ?>">

            <button type="submit">Atualizar Pedido</button>
        </form>

        <h2>Detalhes do Pedido</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order['products'] as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td>R$ <?php echo number_format($product['price_each'], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($product['total'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/admin/order_details/<?= $order['order_id'] ?>" class="button">Ver Detalhes</a>
        <a href="/admin/orders" class="button">Voltar para Pedidos</a>
    </div>
</body>
</html>