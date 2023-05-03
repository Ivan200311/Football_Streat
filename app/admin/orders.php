<?php

use App\models\Order;

$style = '/accers/css/admin.css';

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$orders = Order::all();
$statuses = Order::AllOrderStatuses();
if (!empty($_GET) && isset($_GET["status"])) {
    if ($_GET["status"] !== 'all') {
    $orders = Order::ordersByManyStatuses($_GET["status"]);
    }
    } else {
    }
    
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/admin/orders.view.php';