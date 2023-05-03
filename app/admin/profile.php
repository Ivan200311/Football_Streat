<?php

use App\models\User;

$style = '/accers/css/admin.css';

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$user = User::find($_SESSION['id']);

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/admin/profile.view.php';