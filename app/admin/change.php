<?php

use App\models\Order;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$stream = file_get_contents("php://input");
if ($stream != null) {
 $id = json_decode($stream)->id;
 $status_id = json_decode($stream)->statusId;
 $reason_cancel = json_decode($stream)->reason_cancel;
 $shange = Order::shangeStatus($id, $status_id, $reason_cancel);
 echo json_encode($shange, JSON_UNESCAPED_UNICODE);
}
header("Location: /app/admin/orders.php")

?>