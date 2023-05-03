<?php

namespace App\models;

use App\helpers\Connection;

class Role
{

    public static function connect($config = CONFIG_CONNECTION)
    {
        return Connection::make($config);
    }

    public static function all()
    {
        $query = self::connect()->query('SELECT * FROM roles');
        return $query->fetchAll();
    }
}