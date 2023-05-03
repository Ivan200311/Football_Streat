<?php

use App\models\Product;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_POST['create'])) {
    $product = Product::add($_POST['name'], $_POST['price'], $_POST['photo'], $_POST['description'], $_POST['year_release'], $_POST['category_id'], $_POST['brand_id'], $_POST['country_id'], $_POST['quantity'], $_POST['table_size_id']);
}
header('Location: /app/admin/products.php');
