<?php

$style = '/accers/css/index.css';

use App\models\Size;
use App\models\Brand;
use App\models\Product;
use App\models\Country;
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
unset($_SESSION['products']);

$sizes = Size::SizeKipa();

$brands = Brand::BrandAll();

$countries = Country::CountryKipa();

if(isset($_SESSION["productsKipa"])){
    $products =$_SESSION["productsKipa"];
}
else{
    $products = Product::kipaAll();
}

if (isset($_SESSION["filtersKipa"])) {
    $products = $_SESSION["filtersKipa"];
} else {
    $products = Product::KipaAll();
}



require_once $_SERVER['DOCUMENT_ROOT'] . '/views/products/basket/kipa.view.php';
unset($_SESSION["filtersKipa"]);
unset($_SESSION["save"]);