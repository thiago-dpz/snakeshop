<?php

header("Content-Type: application/json");

require("models/products.php");
$model = new Products();

if (isset($_POST["request"])) {
    $request = $_POST["request"];
    $productId = isset($_POST["product_id"]) ? intval($_POST["product_id"]) : null;

    if ($request === "addProduct" && $productId) {
        $product = $model->getDetail($productId);
        if ($product) {
            $_SESSION["cart"][$productId]["quantity"] = ($_SESSION["cart"][$productId]["quantity"] ?? 0) + 1;
            echo json_encode(["success" => true, "message" => "Produto adicionado ao carrinho!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Produto não encontrado."]);
        }
    } elseif ($request === "removeProduct" && $productId) {
        unset($_SESSION["cart"][$productId]);
        echo json_encode(["success" => true, "message" => "Produto removido do carrinho."]);
    } elseif ($request === "changeQuantity" && $productId && isset($_POST["quantity"])) {
        $quantity = intval($_POST["quantity"]);
        $product = $model->getDetail($productId);

        if ($product && $quantity > 0 && $quantity <= $product["stock"]) {
            $_SESSION["cart"][$productId]["quantity"] = $quantity;
            echo json_encode(["success" => true, "message" => "Quantidade atualizada."]);
        } else {
            echo json_encode(["success" => false, "message" => "Quantidade inválida ou estoque insuficiente."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Requisição inválida."]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["success" => false, "message" => "Método não permitido."]);
exit;