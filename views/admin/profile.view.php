<?php 
session_start();
if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("Location: /app/admin/auth.php");
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.admin.php'; ?>
<div class="conteiner">
    <div class="cont cont_panel">
    </div>
</div>

</div>