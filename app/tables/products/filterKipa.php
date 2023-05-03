<?php

use App\models\Product;
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
session_start();

$_SESSION["filtersKipa"] = Product::filterKipa($_POST["country"]??"",$_POST["brand"]??"",$_POST["size"]??"", $_POST["sort"]??"");
echo "<pre>";

echo "</pre>";
unset($_SESSION["save"]);
if(isset($_POST["country"])){
    $_SESSION["save"]["country"] = $_POST["country"];
}
if(isset($_POST["brand"])){
    $_SESSION["save"]["brand"] = $_POST["brand"];
}
if(isset($_POST["size"])){
    $_SESSION["save"]["size"] = $_POST["size"];
}
if(isset($_POST["sort"])){
    $_SESSION["save"]["sort"] = $_POST["sort"];
}




header("Location: /app/tables/products/kipa.php");