<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/adminproducts.css"> 
    <script>
        function confirmDelete() {
            return confirm("Você realmente deseja excluir este produto?");
        }
    </script>
</head>
<body>

<h1 class="page-title">Produtos</h1>
<a class="add-button" href="<?= ROOT ?>/admin/create_products">Adicionar Novo Produto</a>
<table class="product-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Gênero</th>
            <th>Filhote</th>
            <th>Estoque</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['category_id']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td><?= htmlspecialchars($product['description']) ?></td>
                <td><?= htmlspecialchars($product['gender']) ?></td>
                <td><?= $product['is_hatchling'] ? 'Sim' : 'Não' ?></td>
                <td><?= htmlspecialchars($product['stock']) ?></td>
                <td>
                    <?php if (!empty($product['image'])): ?>
                        <img class="product-image" src="<?= ROOT ?>/images/<?= htmlspecialchars($product['image']) ?>" alt="Imagem do Produto" style="max-width: 100px; max-height: 100px;">
                    <?php else: ?>
                        <p>Nenhuma imagem</p>
                    <?php endif; ?>
                </td>
                <td>
                    <a class="action-link" href="<?= ROOT ?>/admin/edit_products/<?= $product['product_id'] ?>">Editar</a>
                    <a class="action-link" href="<?= ROOT ?>/admin/delete_products/<?= $product['product_id'] ?>" onclick="return confirmDelete();">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>