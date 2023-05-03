<?php

namespace App\models;

use App\helpers\Connection;

class Country
{
    public static function CountryBoots()
    {
        $query = Connection::make()->query("SELECT DISTINCT countries.id, countries.name as country FROM countries
        INNER JOIN products ON products.country_id=countries.id
                WHERE products.category_id=1");
        return $query->fetchAll();
    }

    public static function CountryKipa()
    {
        $query = Connection::make()->query("SELECT DISTINCT countries.id, countries.name as country FROM countries
        INNER JOIN products ON products.country_id=countries.id
                WHERE products.category_id=2");
        return $query->fetchAll();
    }
    public static function all()
    {
        $query = Connection::make()->query("SELECT * FROM countries");
        return $query->fetchAll();
    }

}