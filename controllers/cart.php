<?php

require("models/products.php");

$model = new Products();

if (!isset($_SESSION['user_id'])) {
    header("Location: " . ROOT . "/login/");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["product_id"]) && isset($_POST["quantity"])) {
        $product_id = $_POST["product_id"];
        $quantity = intval($_POST["quantity"]);

        $product = $model->getDetail($product_id);

        if ($product && $quantity > 0) {
            $current_quantity_in_cart = $_SESSION["cart"][$product["product_id"]]["quantity"] ?? 0;
            $total_quantity_requested = $current_quantity_in_cart + $quantity;

            if ($total_quantity_requested <= $product["stock"]) {
                if (isset($_SESSION["cart"][$product["product_id"]])) {
                    $_SESSION["cart"][$product["product_id"]]["quantity"] += $quantity;
                } else {
                    $_SESSION["cart"][$product["product_id"]] = [
                        "product_id" => $product["product_id"],
                        "quantity" => $quantity,
                        "name" => $product["name"],
                        "price" => $product["price"],
                        "stock" => $product["stock"]
                    ];
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Estoque insuficiente para a quantidade desejada.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Produto indisponível ou quantidade inválida.']);
        }
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    echo json_encode(['success' => true, 'cart' => $cart]);
    exit;
} else {
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    include("views/cart.php");
}