<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/products.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/menu.css"> 
</head>
<body>
    <?php require("views/templates/menu.php"); ?>
    <h1>Produtos da Categoria</h1>

    <div>
        <form action="<?= ROOT ?>/category/<?= $category['category_id'] ?>" method="post">
            <label><input type="radio" name="filter" value="" <?= $filter === '' ? 'checked' : '' ?>> Todos</label>
            <label><input type="radio" name="filter" value="male" <?= $filter === 'male' ? 'checked' : '' ?>> Machos</label>
            <label><input type="radio" name="filter" value="female" <?= $filter === 'female' ? 'checked' : '' ?>> Fêmeas</label>
            <label><input type="radio" name="filter" value="hatchlings" <?= $filter === 'hatchlings' ? 'checked' : '' ?>> Filhotes</label>
            <button type="submit" name="send">Aplicar Filtro</button>
        </form>
    </div>

    <div>
        <button onclick="window.location.href='<?= ROOT ?>/categories/'" class="btn-return">Retornar às Categorias</button>
    </div>

    <?php if (!empty($products)): ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <img src="<?= ROOT ?>/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <p>Preço: R$ <?= number_format($product['price'], 2, ',', '.') ?></p>
                    
                    <button onclick="window.location.href='<?= ROOT ?>/productdetail/<?= $product['product_id'] ?>'">Ver Detalhes</button>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form class="add-to-cart-form" data-product_id="<?= $product['product_id'] ?>">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <label for="quantity-<?= $product['product_id'] ?>">Quantidade:</label>
                            <input type="number" id="quantity-<?= $product['product_id'] ?>" name="quantity" min="1" max="<?= $product['stock'] ?>" value="1">
                            <button type="button" class="add-to-cart-btn">Adicionar ao Carrinho</button>
                        </form>
                    <?php else: ?>
                        <p><a href="<?= ROOT ?>/login/" class="btn-login">Faça login para comprar.</a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Nenhum produto encontrado.</p>
    <?php endif; ?>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll('.add-to-cart-btn');

        buttons.forEach(button => {
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
    });
    </script>
</body>
</html>