<?php

if (isset($_POST["send"])) {

    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    if (
        isset($_POST["agrees"]) &&
        !empty($_POST["name"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["street_address"]) &&
        !empty($_POST["city"]) &&
        !empty($_POST["postal_code"]) &&
        !empty($_POST["state"]) &&
        !empty($_POST["phone"]) &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        $_POST["password"] === $_POST["password_confirm"] &&
        mb_strlen($_POST["name"]) >= 3 &&
        mb_strlen($_POST["name"]) <= 60 &&
        mb_strlen($_POST["password"]) >= 8 &&
        mb_strlen($_POST["password"]) <= 1000 &&
        mb_strlen($_POST["street_address"]) >= 8 &&
        mb_strlen($_POST["street_address"]) <= 120 &&
        mb_strlen($_POST["postal_code"]) >= 4 &&
        mb_strlen($_POST["postal_code"]) <= 20 &&
        mb_strlen($_POST["city"]) >= 3 &&
        mb_strlen($_POST["city"]) <= 50 &&
        mb_strlen($_POST["phone"]) >= 9 &&
        mb_strlen($_POST["phone"]) <= 30
    ) {
        require("models/users.php");
        $model = new Users();

        $user = $model->getByEmail($_POST["email"]);

        if (empty($user)) {
            $createdUser = $model->create($_POST);

            $_SESSION["user_id"] = $createdUser["user_id"];
            header("Location: " . ROOT . "/");  
        } else {
            $message = "Usuário já existe";
        }
    } else {
        $message = "Preencha os campos corretamente";
    }
}

require("views/register.php");