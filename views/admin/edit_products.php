<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="/css/edit_products.css">
    <link rel="stylesheet" href="/css/backoffice_menu.css">
</head>
<body>
    <?php require('views/templates/backoffice_menu.php'); ?>

<h1 class="page-title">Editar Produto</h1>

<form class="product-form" method="POST" action="<?= ROOT ?>/admin/edit_products/<?= $product['product_id'] ?>" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

    <label for="name">Nome:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label for="category_id">Categoria ID:</label>
    <input type="number" name="category_id" value="<?= htmlspecialchars($product['category_id']) ?>" required>

    <label for="price">Preço:</label>
    <input type="text" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <label for="description">Descrição:</label>
    <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>

    <label for="gender">Gênero:</label>
    <select name="gender" required>
        <option value="male" <?= $product['gender'] === 'male' ? 'selected' : '' ?>>Masculino</option>
        <option value="female" <?= $product['gender'] === 'female' ? 'selected' : '' ?>>Feminino</option>
    </select>

    <label for="is_hatchling">Filhote:</label>
    <select name="is_hatchling" required>
        <option value="1" <?= $product['is_hatchling'] ? 'selected' : '' ?>>Sim</option>
        <option value="0" <?= !$product['is_hatchling'] ? 'selected' : '' ?>>Não</option>
    </select>

    <label for="stock">Estoque:</label>
    <input type="number" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>

    <label for="image">Imagem:</label>
    <input type="file" name="image" accept="image/*"> 
    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($product['image']) ?>"> 

    <button type="submit">Salvar Alterações</button>
    
    <a class="back-link" href="<?= ROOT ?>/admin/products">Voltar</a>
</form>

</body>
</html>