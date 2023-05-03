<?php

use App\models\Category;
use App\models\Product;
use App\models\Country;
use App\models\Brand;
use App\models\Size;

$style = '/accers/css/admin.css';

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$stream = file_get_contents("php://input");
if ($stream != null) {
 $id = json_decode($stream)->id;
 $delete = Product::delete($id);
 echo json_encode( $delete, JSON_UNESCAPED_UNICODE);
}

$categories = Category::all();
$countries = Country::all();
$brands = Brand::BrandAll();
$sizes = Size::sizeAll();
include $_SERVER['DOCUMENT_ROOT'] . '/views/admin/products.view.php';
