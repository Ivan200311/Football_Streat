<?php

$style = '/accers/css/index.css';

use App\models\Role;


require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$roles = Role::all();

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/create.view.php';