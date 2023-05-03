<?php

$style = '/accers/css/index.css';
use App\models\Delivery;
use App\models\Basket;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
if (!isset($_SESSION["auth"]) || !$_SESSION["auth"]) {
    header("Location: /app/tables/users/auth.php");

    die(); 

    }
   
$user_id = $_SESSION['id'];
$productsInBasket = Basket::allProductByUser($user_id);
$sum = Basket::sum($user_id);
$count = Basket::count($user_id);
$deliveries = Delivery::allAddress();


require_once $_SERVER['DOCUMENT_ROOT'] . '/views/basket/basket.view.php';
