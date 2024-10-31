<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    include("controllers/error.php");
    exit();
}

require("models/categories.php");
$model = new Categories();
$category = $model->get($id);

if (empty($category)) {
    http_response_code(404);
    include("controllers/error.php");
    exit();
}

require("models/products.php");
$productModel = new Products();
$filter = "";
$products = $productModel->getByCategoryAndFilter($id, $filter);
if (isset($_POST['send'])) {
    $filter = $_POST['filter'];
    $products = $productModel->getByCategoryAndFilter($id, $filter);
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

require("views/category.php");