<?php

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

require("views/productdetail.php"); 