<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . ROOT . "/admin/login"); 
    exit;
}
require("models/orders.php");

$model = new Orders();

$order_id = basename($_SERVER['REQUEST_URI']);

if ($order_id) {
    $order = $model->getDetail($order_id);

    if (!$order) {
        echo "Pedido não encontrado.";
        exit();
    }

    require("views/admin/order_details.php");
} else {
    echo "ID do pedido não especificado.";
}