<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$extensions = ["jpg", "jpeg", "png", "webp", "jfif"];
$types = ["photo/jpeg", "photo/png", "photo/webp", "photo/jfif"];

if ($_FILES["photo"]["name"] != "") {
    $name = $_FILES["photo"]["name"];
    $tmpName = $_FILES["photo"]["tmp_name"];
    $error = $_FILES["photo"]["error"];
    $size = $_FILES["photo"]["size"];
    $path_parts = pathinfo($name);
    $nameinServer = time(). "_". $name;
    $img = $name;
    if ($error == 0) {
        if ($size > 30000000 ) {
            $_SESSION["error"] = "Файл слишком большой";
        } else {
            if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"]."/upload/" . $nameinServer)) {
                
                $_SESSION["error"] = "Файл не загрузился";

            }
            else{
                if (isset($_POST["save"])) {

                    if ($_POST["id"] != null) {

                        
                        Product::update($_POST, $img);
                        
                    }
                }
            };
        }
    } else {
        $_SESSION["error"] = "Ошибка";
    };
} else {
    Product::updateNoImage($_POST);
};
header("Location: /app/admin/products.php");