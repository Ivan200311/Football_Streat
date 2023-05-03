<?php

use App\models\Order;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$user_id = $_SESSION['id'];
if (isset($_POST["delivery_id"])
&& !empty($_POST["delivery_id"])){
    Order::create($user_id, $_POST["delivery_id"]);
}else{
    $_SESSION["error"]="Не выбран пунк замовывоза";
   
}



header('Location:/app/tables/basket/basket.php');