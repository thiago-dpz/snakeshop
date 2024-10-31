<?php


if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login/");
    exit;
}

if (empty($_SESSION["cart"])) {
    header("Location: " . ROOT . "/");
    exit;
}

$message = ""; 
$messageType = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["city"]) && !empty($_POST["postal_code"])) {
        require("models/orders.php");
        require("models/products.php");

        $modelOrders = new Orders();
        $modelProducts = new Products();

        $payment_reference = $modelOrders->getPaymentRef();
        $order_id = $modelOrders->createHeader($_SESSION["user_id"], $payment_reference);

        $total = 0;

        foreach ($_SESSION["cart"] as $item) {
            $productId = $item["product_id"];
            $quantity = $item["quantity"];

            $modelOrders->createDetail($order_id, $item);
            $modelProducts->updateStock($productId, $quantity);

            $total += $quantity * $item["price"];
        }

        unset($_SESSION["cart"]); 

        $message = "Pedido feito com sucesso!"; 
        $messageType = "success"; 
    } else {
        $message = "Falha no pedido, insira todos os dados!";
        $messageType = "error"; 
    }
}

require("views/checkout.php"); 