<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/productdetail.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/menu.css">
</head>
<body>
    <?php require("views/templates/menu.php"); ?>
    <div class="product-panel">
        <a href="<?= ROOT ?>/category/<?= $product['category_id'] ?>" class="btn-back">← Voltar para a categoria</a>
        
        <div class="product-content">
            <div class="product-image">
                <img src="<?= ROOT ?>/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>

            <div class="product-details">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Estoque: <?= htmlspecialchars($product['stock']) ?></p>
                <p class="product-price">Preço: R$ <?= number_format($product['price'], 2, ',', '.') ?></p>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form class="add-to-cart-form" data-product_id="<?= $product['product_id'] ?>">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <label for="quantity">Quantidade:</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="<?= $product['stock'] ?>" value="1">
                        <button type="button" class="add-to-cart-btn">Adicionar ao Carrinho</button>
                    </form>
                <?php else: ?>
                    <p><a href="<?= ROOT ?>/login/" class="btn-back">Faça login para comprar</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const button = document.querySelector('.add-to-cart-btn');
            button.addEventListener('click', () => {
                const form = button.closest('.add-to-cart-form');
                const formData = new FormData(form);

                fetch("<?= ROOT ?>/cart/", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert("Produto adicionado ao carrinho!");
                    } else {
                        alert("Erro ao adicionar produto ao carrinho: " + result.message);
                    }
                })
                .catch(error => {
                    console.error("Erro:", error);
                    alert("Erro inesperado ao adicionar produto ao carrinho.");
                });
            });
        });
    </script>
</body>
</html>