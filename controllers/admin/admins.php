<?php

// NÃO FINALIZADO //

require_once("models/admins.php");

$model = new Admins();

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        $admins = $model->getAll(); 
        require("views/admins/list.php");
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            $model->create($data);
            header("Location: " . ROOT . "/admin/admins.php?action=list");
            exit;
        }
        require("views/admins/create.php");  
        break;
    default:
        header("Location: " . ROOT . "/admin/admins.php?action=list");
        exit;
}
?>