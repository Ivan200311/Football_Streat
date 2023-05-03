<?php

use App\models\Basket;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

//получаем поток для работы с данными
$stream = file_get_contents('php://input'); //вход с входными данными
if ($stream != null) {
    //декодируем полученные данные
    $product_id = json_decode($stream)->data;
    $user_id = $_SESSION['id'];
    $action = json_decode($stream)->action;
    // var_dump(json_decode($stream));
    $productInBasket = match ($action) {
        'add' => Basket::add($product_id->product_id, $user_id, $product_id->size_product_id),
        'delete' => Basket::delete($product_id, $user_id),
        'reduce' => Basket::reduce($product_id->product_id, $user_id, $product_id->size_product_id),
        'clear' => Basket::clear($user_id)
    };
    // var_dump($productInBasket);
    echo json_encode([
        "productInBasket" => $productInBasket,
        "sum" => Basket::sum($user_id),
        "count" => Basket::count($user_id)
    ], JSON_UNESCAPED_UNICODE);
}
