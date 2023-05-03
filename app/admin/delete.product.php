<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$stream = file_get_contents("php://input");
if ($stream != null) {
 $id = json_decode($stream)->id;
 $image = json_decode($stream)->photo;
 unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $image);
$delete = Product::delete($id);
 echo json_encode($delete, JSON_UNESCAPED_UNICODE);
}
header('Location: /app/admin/products.php');