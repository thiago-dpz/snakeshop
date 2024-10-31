<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Snakeshop</title>
    <link rel="stylesheet" href="<?= ROOT ?>/css/menu.css"> 
    <link rel="stylesheet" href="<?= ROOT ?>/css/categories.css"> 
</head>
<body>
    <?php require("templates/menu.php"); ?>
    
    <h1>Categorias</h1>
    
    <ul class="category-list">
        <?php
        foreach ($categories as $category) {
            $category_name = htmlspecialchars($category["name"], ENT_QUOTES, 'UTF-8');
            $category_id = intval($category["category_id"]);
            $category_url = ROOT . '/category/' . $category_id . '""';
            
            echo '
                <li>
                    <a href="' . ROOT . '/category/' . $category_id . '">
                        ' . $category_name . '
                    </a>
                </li>
            ';
        }
        ?>
    </ul>
</body>
</html>