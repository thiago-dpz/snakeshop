<?php
    if (!isset($_SESSION['admin_id'])) {
        header("Location: " . ROOT . "/admin/login"); 
        exit;
    }

require("views/admin/dashboard.php");