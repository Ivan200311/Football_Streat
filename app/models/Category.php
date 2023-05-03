<?php

namespace App\models;

use App\helpers\Connection;

class Category
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT id, name FROM categories");
        return $query->fetchAll();
    }
}