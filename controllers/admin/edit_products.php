<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . ROOT . "/admin/login");
    exit;
}
if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    include("controllers/error.php");
    exit();
}

require("models/products.php");
$model = new Products();
$product = $model->getDetail($id);
if (empty($product)) {
    http_response_code(404);
    include("controllers/error.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../images/'; 
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $_POST['image'] = $_FILES['image']['name'];
            $model->update($_POST, $_POST['product_id']);
            header("Location: " . ROOT . "/admin/products");
            exit;
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        $model->update($_POST, $id);
        header("Location: " . ROOT . "/admin/products");
        exit;
    }
}

require("views/admin/edit_products.php");