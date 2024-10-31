<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/create_product.css">
</head>
<body>

<h1 class="page-title">Adicionar Novo Produto</h1>

<form class="product-form" method="POST" action="<?= ROOT ?>/admin/create_products" enctype="multipart/form-data">
    <label for="name">Nome:</label>
    <input type="text" name="name" required>

    <label for="category_id">Categoria ID:</label>
    <input type="number" name="category_id" required>

    <label for="price">Preço:</label>
    <input type="text" name="price" required>

    <label for="description">Descrição:</label>
    <textarea name="description" required></textarea>

    <label for="gender">Gênero:</label>
    <select name="gender" required>
        <option value="male">Masculino</option>
        <option value="female">Feminino</option>
    </select>

    <label for="is_hatchling">Filhote:</label>
    <select name="is_hatchling" required>
        <option value="1">Sim</option>
        <option value="0">Não</option>
    </select>

    <label for="stock">Estoque:</label>
    <input type="number" name="stock" required>

    <label for="image">Imagem:</label>
    <input type="file" name="image" accept="image/*" required> 

    <button type="submit">Adicionar Produto</button>
    
    <a class="back-link" href="<?= ROOT ?>/admin/products">Voltar</a>
</form>

</body>
</html>