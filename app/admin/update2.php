<?php

use App\models\Category;
use App\models\Country;
use App\models\Product;
use App\models\Brand;
use App\models\Size;
use App\models\Quantity;
$style = '/accers/css/admin.css';

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("Location: /app/admin/auth.php");
    die();
}

$product = Product::find($_GET["id"]);
$categories = Category::all();
$countries = Country::all();
$brands = Brand::BrandAll();
$sizes = Size::sizeAll();
$sizes_product=Size::sizeProduct($product->id);
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/admin/update.view.php";