<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/checkout.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/menu.css">
</head>
<body>
    <?php require("views/templates/menu.php"); ?>
    <main>
        <h1>Finalizar Compra</h1>
        
        <div class="checkout-container">
            <div class="checkout-panel">
                <form action="<?= ROOT ?>/checkout/" method="POST">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Telefone:</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="city">Cidade:</label>
                    <input type="text" id="city" name="city" required>

                    <label for="state">Estado:</label>
                    <input type="text" id="state" name="state" required>

                    <label for="postal_code">Código Postal:</label>
                    <input type="text" id="postal_code" name="postal_code" required>

                    <label for="address">Endereço:</label>
                    <input type="text" id="address" name="address" required>

                    <label for="payment_method">Método de Pagamento:</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="cartao">Cartão</option>
                        <option value="boleto">Boleto</option>
                    </select>

                    <button type="submit">Finalizar Compra</button>
                </form>

                <?php if (!empty($message)): ?>
                    <div class="<?= $messageType ?>">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="order-summary-panel">
                <h2>Resumo da Compra</h2>
                <?php
                    $total = 0;
                    if (!empty($_SESSION["cart"])) {
                        echo '<ul>';
                        foreach ($_SESSION["cart"] as $item) {
                            $subtotal = $item["quantity"] * $item["price"];
                            $total += $subtotal;
                            echo '<li>';
                            echo "<strong>Produto:</strong> {$item["name"]}<br>";
                            echo "<strong>Quantidade:</strong> {$item["quantity"]}<br>";
                            echo "<strong>Subtotal:</strong> R$ " . number_format($subtotal, 2, ',', '.') . "<br>";
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo "<p class='total'><strong>Total:</strong> R$ " . number_format($total, 2, ',', '.') . "</p>";
                    } else {
                        echo "<p>Seu carrinho está vazio.</p>";
                    }
                ?>
            </div>
        </div>
    </main>
</body>
</html>