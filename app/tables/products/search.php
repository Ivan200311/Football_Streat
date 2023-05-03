<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
use App\models\Product;


$productsSearch = Product::search($_POST["name"]."%");

$_SESSION["productssss"]=$productsSearch;


header("Location: /app/tables/products/boots.php");