<?php



use App\models\Quantity;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (isset($_GET["id"])) {
    $id = json_decode($_GET["id"]);
    
    echo json_encode(Quantity::quantity($id), JSON_UNESCAPED_UNICODE);
}       
