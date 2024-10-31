<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . ROOT . "/admin/login");
    exit;
}

require("models/products.php");
$model = new Products();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $products = $model->getAll(); 
        require("views/admin/products.php");
        break;
    case 'create':
        require("views/admin/products/create.php");
        break;
    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                "name" => $_POST['name'],
                "category_id" => $_POST['category_id'],
                "price" => $_POST['price'],
                "description" => $_POST['description'],
                "gender" => $_POST['gender'],
                "is_hatchling" => $_POST['is_hatchling'],
                "stock" => $_POST['stock'], 
                "image" => '' 
            ];
            $model->create($data);
            header("Location: " . ROOT . "/admin/products");
            exit;
        }
        break;
    default:
        http_response_code(404);
        include("controllers/error.php");
        break;
}