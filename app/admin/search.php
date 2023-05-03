<?php


use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (isset($_GET["category"])) {
    $categories = json_decode($_GET["category"]);
    
    if (empty($categories) || $categories == "all") {
        $products = Product::all();
    } else {
        $products = Product::productsByManyCategories($categories);
    }
    echo json_encode($products, JSON_UNESCAPED_UNICODE);
}   