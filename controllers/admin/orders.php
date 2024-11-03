<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . ROOT . "/admin/login"); 
    exit;
}
require("models/orders.php");

$model = new Orders();
$orders = $model->getAll();

// Inclui a view para listagem de pedidos
require("views/admin/orders.php");