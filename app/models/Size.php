<?php

namespace App\models;

use App\helpers\Connection;

class Size
{
    public static function SizeBoots()
    {
        $query = Connection::make()->query("SELECT DISTINCT table_sizes.* FROM table_sizes
        INNER JOIN size_products ON table_sizes.id=size_products.table_size_id
        INNER JOIN products ON products.id=size_products.product_id
                WHERE products.category_id=1");
        return $query->fetchAll();
    }

    public static function SizeKipa()
    {
        $query = Connection::make()->query("SELECT DISTINCT table_sizes.* FROM table_sizes
        INNER JOIN size_products ON table_sizes.id=size_products.table_size_id
        INNER JOIN products ON products.id=size_products.product_id
        WHERE products.category_id=2");
        return $query->fetchAll();
    }

    public static function sizeProduct($id)
    {
        $query = Connection::make()->prepare("SELECT DISTINCT size_products.id as ptr,   table_sizes.size FROM table_sizes
        INNER JOIN size_products ON table_sizes.id=size_products.table_size_id
        WHERE size_products.product_id=:id");
        $query->execute(['id'=>$id]);
        return $query->fetchAll();
    }
    public static function sizeAll()
    {
        $query = Connection::make()->query("SELECT * FROM table_sizes");
        return $query->fetchAll();
    }
}

