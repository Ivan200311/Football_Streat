<?php

namespace App\models;

use App\helpers\Connection;

class Delivery
{
    public static function allAddress()
    {
        $query = Connection::make()->query("SELECT * FROM delivery");
        return $query->fetchAll();
    }
}