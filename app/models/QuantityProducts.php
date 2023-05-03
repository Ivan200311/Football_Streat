<?php

namespace App\models;

use App\helpers\Connection;

class Quantity
{
    public static function quantity($table_id)
    {
        // var_dump([
        //     'table_id'=>$table_id,
        //     "product_id"=>$id
        // ]);
        $query = Connection::make()->prepare("SELECT
        size_products.quantity
    FROM
        size_products
    WHERE
        size_products.id = :table_id  ");
        $query->execute([
            'table_id'=>$table_id
    ]);
    // var_dump($query->fetch());
        return $query->fetch();
    }

}
// $query = Connection::make()->prepare("SELECT
// size_products.quantity
// FROM
// size_products
// WHERE
// size_products.table_size_id = :table_id AND  size_products.product_id=:product_id ");
// $query->execute([
//     'table_id'=>$table_id,
//     "product_id"=>$id
// ]);