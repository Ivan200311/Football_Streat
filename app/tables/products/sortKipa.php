<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
use App\models\Sortirovka;
if(isset($_POST["sortKipa"])){
    if($_POST["sortKipa"] == "ASCkipa"){
        $_SESSION["productsKipa"] = Sortirovka::MaxPriceKipa();
    }
}
if(isset($_POST["sortKipa"])){
        if($_POST["sortKipa"] == "DESCkipa"){
            $_SESSION["productsKipa"] = Sortirovka::MinPriceKipa();
        }
}
if(isset($_POST["sortKipa"])){
    if($_POST["sortKipa"] == "NaimAkipa"){
        $_SESSION["productsKipa"] = Sortirovka::MaxNameKipa();
    }
}
if(isset($_POST["sortKipa"])){
    if($_POST["sortKipa"] == "NaimBkipa"){
        $_SESSION["productsKipa"] = Sortirovka::MinNameKipa();
    }
}
if(isset($_POST["sortKipa"])){
    if($_POST["sortKipa"] == "CountryAkipa"){
        $_SESSION["productsKipa"] = Sortirovka::MaxCountryKipa();
    }
}
if(isset($_POST["sortKipa"])){
    if($_POST["sortKipa"] == "CountryBkipa"){
        $_SESSION["productsKipa"] = Sortirovka::MinCountryKipa();
    }
}
header("Location: /app/tables/products/kipa.php");