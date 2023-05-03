<?php

use App\models\Order;

$style = '/accers/css/admin.css';

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$productsInOrder = Order::productsByOrder(($_GET["id"]));

require_once $_SERVER["DOCUMENT_ROOT"] . "/views/admin/productsByOrder.view.php";