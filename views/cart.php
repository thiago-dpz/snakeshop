<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/cart.css">
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const table = document.querySelector('table');
            const totalRow = document.querySelector('tr.total-row');
            
            document.querySelectorAll('button[name="remove"]').forEach(button => {
                button.addEventListener("click", () => {
                    const tr = button.closest("tr");
                    const productId = tr.dataset.product_id;

                    fetch("<?= ROOT ?>/requests/", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "request=removeProduct&product_id=" + productId
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            tr.remove();
                            updateTotal(); 
                            
                            if (document.querySelectorAll('tr[data-product_id]').length === 0) {
                                table.style.display = "none";
                                document.querySelector('main').innerHTML += '<p role="alert">Carrinho vazio</p>'; 
                                document.querySelector('nav a[href="<?= ROOT ?>/checkout/"]').style.display = 'none'; 
                            }
                        }
                    });
                });
            });

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('tr[data-product_id]').forEach(tr => {
                    const price = parseFloat(tr.querySelector('td:nth-child(3)').innerText.replace('R$', '').trim().replace('.', '').replace(',', '.'));
                    const quantity = parseInt(tr.querySelector('td:nth-child(2)').innerText); 
                    total += price * quantity;
                });
                totalRow.querySelector('td:nth-child(2)').innerText = `R$ ${total.toFixed(2).replace('.', ',')}`; 
            }
        });
    </script>
</head>
<body>
    <main>
        <h1>Carrinho</h1>
        <?php if (empty($_SESSION["cart"])): ?>
            <p role="alert">Carrinho vazio</p>
        <?php else: ?>
            <table>
                <tr><th>Produto</th><th>Quantidade</th><th>Preço</th><th>Subtotal</th><th>Remover</th></tr>
                <?php $total = 0; ?>
                <?php foreach ($_SESSION["cart"] as $item): 
                    $subtotal = $item["price"] * $item["quantity"];
                    $total += $subtotal;
                ?>
                    <tr data-product_id="<?= $item["product_id"] ?>">
                        <td><?= htmlspecialchars($item["name"]) ?></td>
                        <td><?= htmlspecialchars($item["quantity"]) ?></td> 
                        <td>R$ <?= htmlspecialchars(number_format($item["price"], 2, ',', '.')) ?></td>
                        <td>R$ <?= htmlspecialchars(number_format($subtotal, 2, ',', '.')) ?></td>
                        <td><button type="button" name="remove">X</button></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row"><td colspan="3">Total</td><td colspan="2">R$ <?= htmlspecialchars(number_format($total, 2, ',', '.')) ?></td></tr>
            </table>
        <?php endif; ?>
        <nav>
            <a href="<?= ROOT ?>/categories/">Escolher produtos</a>
            <?php if (!empty($_SESSION["cart"])): ?>
                <a href="<?= ROOT ?>/checkout/">Comprar</a>
            <?php endif; ?>
        </nav>
    </main>
</body>
</html>