<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
use App\models\Sortirovka;
if(isset($_POST["sort"])){
    if($_POST["sort"] == "ASC"){
        $_SESSION["products"] = Sortirovka::MaxPrice();
    }
}
if(isset($_POST["sort"])){
        if($_POST["sort"] == "DESC"){
            $_SESSION["products"] = Sortirovka::MinPrice();
        }
}
if(isset($_POST["sort"])){
    if($_POST["sort"] == "NaimA"){
        $_SESSION["products"] = Sortirovka::MaxName();
    }
}
if(isset($_POST["sort"])){
    if($_POST["sort"] == "NaimB"){
        $_SESSION["products"] = Sortirovka::MinName();
    }
}
if(isset($_POST["sort"])){
    if($_POST["sort"] == "CountryA"){
        $_SESSION["products"] = Sortirovka::MaxCountry();
    }
}
if(isset($_POST["sort"])){
    if($_POST["sort"] == "CountryB"){
        $_SESSION["products"] = Sortirovka::MinCountry();
    }
}
header("Location: /app/tables/products/boots.php");