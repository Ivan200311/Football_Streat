<?php

$style = '/accers/css/index.css';

use App\models\Delivery;
use App\models\Information;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$deliveries = Delivery::allAddress();
$informations = Information::informat();

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/aboutUs.view.php';