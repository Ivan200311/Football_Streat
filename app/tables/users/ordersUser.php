<?php

$style = '/accers/css/index.css';

session_start();

use App\models\User;


require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
$user = User::ordersUser($_SESSION['id']);
$orders = User::ordersUserProducts($_SESSION['id']);



if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header('Location: /');
    die();
}



require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/ordersUser.view.php';