<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . ROOT . "/admin/login");
    exit;
}

require("models/products.php");
$model = new Products();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../images/'; 
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            http_response_code(500);
            echo "Erro ao criar diretório de upload.";
            exit;
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $_POST['image'] = $_FILES['image']['name'];
        } else {
            http_response_code(500);
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            http_response_code(400);
            echo "Erro ao fazer upload da imagem. Código de erro: " . $_FILES['image']['error'];
            exit;
        }
    }

    if ($model->create($_POST)) {
        header("Location: " . ROOT . "/admin/products");
        exit;
    } else {
        http_response_code(500);
        echo "Erro ao criar o produto.";
        exit;
    }
}

require("views/admin/create_products.php");