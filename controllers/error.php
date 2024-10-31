<?php

$errorMessage = "An unexpected error was occurred.";
$statusCode = http_response_code();

$homeUrl = ROOT . "/";

if ((strpos($_SERVER["REQUEST_URI"], "admin") === 1) && isset($_SESSION["admin_id"])) {
    $homeUrl = ROOT . "/admin";
}

switch ($statusCode) {
    case 404:
        $errorMessage = "Sorry, the page you are looking for was not found.";
        break;
    case 400:
        $errorMessage = "Bad Request. Please check your request and try again.";
        break;
    case 500:
        $errorMessage = "Oops! Something went wrong on our end. Please try again later.";
        break;
    case 403:
        $errorMessage = "You do not have permission to access this page.";
        break;
    case 401:
        $errorMessage = "Unauthorized access. Please log in.";
        break;
    default:
        $errorMessage = "An error occurred. Please try again later.";
}

require("views/error.php");