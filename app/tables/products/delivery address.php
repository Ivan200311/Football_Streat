<?php

$style = '/accers/css/index.css';

use App\models\Delivery;


require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$deliveries = Delivery::allAddress();


require_once $_SERVER['DOCUMENT_ROOT'] . '/views/products/basket/delivery.view.php';