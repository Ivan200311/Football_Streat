<?php

use App\models\Sortirovka;

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/helpers/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Product.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Size.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Brand.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Delivery.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Sortirovka.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Information.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Country.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Basket.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/QuantityProducts.php';