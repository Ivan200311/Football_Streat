<?php

namespace App\models;

use App\helpers\Connection;

class Brand
{
    public static function BrandAll()
    {
        $query = Connection::make()->query("SELECT * FROM brands");
        return $query->fetchAll();
    }
}