<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . ROOT . "/admin/login"); 
    exit;
}

require("models/orders.php");

$model = new Orders();

// Extrai o ID do pedido da URL
$order_id = basename($_SERVER['REQUEST_URI']);

// Verifica se o order_id é um número e não está vazio
if (!empty($order_id) && is_numeric($order_id)) {
    // Verifica se a requisição é POST, indicando atualização do pedido
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $status = $_POST["status"];
        $payment_date = !empty($_POST["payment_date"]) ? $_POST["payment_date"] : null;
        $shipping_date = !empty($_POST["shipping_date"]) ? $_POST["shipping_date"] : null;

        // Atualiza o pedido no banco de dados
        $model->updateOrder($order_id, $status, $payment_date, $shipping_date);

        // Redireciona para a página de listagem de pedidos após atualização
        header("Location: /admin/orders");
        exit();
    }

    // Caso não seja POST, exibe o formulário de edição com os dados do pedido
    $order = $model->getDetail($order_id);

    if (!$order) {
        echo "Pedido não encontrado.";
        exit();
    }

    // Inclui a view para edição do pedido
    require("views/admin/edit_order.php");
} else {
    echo "ID do pedido não especificado.";
}