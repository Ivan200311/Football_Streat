<?php

$style = '/accers/css/index.css';

session_start();

use App\models\User;
use App\models\Delivery;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
$deliveries = Delivery::allAddress();
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header('Location: /');
    die();
}

$user = User::find($_SESSION['id']);

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/profile.view.php';