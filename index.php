<?php

$style = '/accers/css/index.css';
use App\models\Product;
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$products = Product::lastNewProducts();

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/products/basket/index.view.php';
