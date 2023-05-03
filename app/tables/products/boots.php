<?php
session_start();
$style = '/accers/css/index.css';

use App\models\Size;
use App\models\Brand;
use App\models\Product;
use App\models\Country;


require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$sizes = Size::SizeBoots();
$brands = Brand::BrandAll();
$countries = Country::CountryBoots();


if (!empty($_SESSION["productssss"])) {
    $products = $_SESSION["productssss"];
} else {

if (isset($_SESSION["products"])) {
    $products = $_SESSION["products"];
} else {
    $products = Product::bootsAll();
}

if (isset($_SESSION["filtersBoots"])) {
    $products = $_SESSION["filtersBoots"];
} else {
    $products = Product::bootsAll();
}

    
}





require_once $_SERVER['DOCUMENT_ROOT'] . '/views/products/basket/boots.view.php';
unset($_SESSION["productssss"]);
unset($_SESSION["filtersBoots"]);
unset($_SESSION["save"]);
