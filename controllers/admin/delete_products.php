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

$delete =  $model->delete($id); 
if ($delete) {
    header("Location: " . ROOT . "/admin/products");
    exit;
}
else {
    http_response_code(500);
    include("controllers/error.php");
    exit();
}

header("Location: " . ROOT . "/admin/products");
exit;