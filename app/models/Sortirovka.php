<?php

namespace App\models;

use App\helpers\Connection;

class Sortirovka
{
    public static function MaxPrice()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=1 ORDER BY products.price DESC");
        return $query->fetchAll();
    }
    public static function MinPrice()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=1 ORDER BY products.price");
        return $query->fetchAll();
    }
    public static function MaxName()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=1 ORDER BY products.name DESC");
        return $query->fetchAll();
    }
    public static function MinName()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=1 ORDER BY products.name ");
        return $query->fetchAll();
    }
    public static function MaxCountry()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price, countries.name FROM products
        INNER JOIN countries ON countries.id = products.country_id
        WHERE products.category_id=1 ORDER BY countries.name DESC");
        return $query->fetchAll();
    }
    public static function MinCountry()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price, countries.name FROM products
        INNER JOIN countries ON countries.id = products.country_id
        WHERE products.category_id=1 ORDER BY countries.name");
        return $query->fetchAll();
    }
    public static function MaxPriceKipa()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=2 ORDER BY products.price DESC");
        return $query->fetchAll();
    }
    public static function MinPriceKipa()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=2 ORDER BY products.price");
        return $query->fetchAll();
    }
    public static function MaxNameKipa()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=2 ORDER BY products.name DESC");
        return $query->fetchAll();
    }
    public static function MinNameKipa()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=2 ORDER BY products.name ");
        return $query->fetchAll();
    }
    public static function MaxCountryKipa()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price, countries.name FROM products
        INNER JOIN countries ON countries.id = products.country_id
        WHERE products.category_id=2 ORDER BY countries.name DESC");
        return $query->fetchAll();
    }
    public static function MinCountryKipa()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price, countries.name FROM products
        INNER JOIN countries ON countries.id = products.country_id
        WHERE products.category_id=2 ORDER BY countries.name");
        return $query->fetchAll();
    }
}
