<?php

$style = '/accers/css/index.css';

use App\models\Product;
use App\models\Size;
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$product = Product::find($_GET['id']);
$sizes = Size::sizeProduct($_GET['id']);
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/products/basket/show.view.php';