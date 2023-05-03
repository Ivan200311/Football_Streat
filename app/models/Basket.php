<?php

namespace App\models;

use App\helpers\Connection;
use App\models\Product;

class Basket
{
    //получаем товары одного пользователя
    public static function allProductByUser($user_id)
    {
        $query = Connection::make()->prepare('SELECT baskets.*, products.photo, products.name, products.price, baskets.quantity*products.price as price_position, table_sizes.size 
        FROM baskets INNER JOIN products ON baskets.product_id=products.id INNER JOIN persons ON baskets.person_id=persons.id INNER JOIN size_products ON size_products.id = baskets.size_products_id INNER JOIN table_sizes ON size_products.table_size_id = table_sizes.id WHERE baskets.person_id=:person_id');
        $query->execute(['person_id' => $user_id]);
        return $query->fetchAll();
    }

    //ищем товар в корзине 
    public static function findProductInBasket($product_id, $user_id, $size_products_id)
    {
        $query =  Connection::make()->prepare('SELECT baskets.*, products.price as products_price, baskets.quantity*products.price as price_position, size_products.quantity as product_count, table_sizes.size  FROM baskets INNER JOIN products ON baskets.product_id=products.id 
        INNER JOIN size_products ON size_products.id = baskets.size_products_id
        INNER JOIN table_sizes ON size_products.table_size_id = table_sizes.id
         WHERE baskets.product_id = :product_id AND baskets.person_id=:person_id AND baskets.size_products_id=:size_products_id');
        //  var_dump([':product_id' => $product_id, ':person_id' => $user_id, "size_products_id"=>$size_products_id]);
        $query->execute([':product_id' => $product_id, ':person_id' => $user_id, "size_products_id" => $size_products_id]);
        return $query->fetch();
    }

    //добавление позиции в корзину
    public static function add($product_id, $user_id, $size_products_id)
    {
        $productInBasket = self::findProductInBasket($product_id, $user_id, $size_products_id);

        $productInStorage = Product::find($product_id);
        // var_dump(['product_id' => $product_id, 'person_id' => $user_id, "size_products_id"=>$size_products_id]);
        //если товара нет в корзине, то добавляем его в корзину в кол = 1, 
        if (!$productInBasket) {
            $query =  Connection::make()->prepare('INSERT INTO baskets (quantity, product_id, person_id,size_products_id) VALUES (1, :product_id, :person_id, :size_products_id)');
            $query->execute(['product_id' => $product_id, 'person_id' => $user_id, "size_products_id" => $size_products_id]);
        }
        //иначе, если кол товара в корзине не больше того, что имеется на складе, то увеличиваем на 1 
        else {
            if ($productInBasket->quantity < $productInStorage->product_count) {
                $query =  Connection::make()->prepare('UPDATE baskets SET quantity=quantity+1 WHERE product_id=:product_id AND person_id=:person_id AND baskets.size_products_id=:size_products_id');
                $query->execute(['product_id' => $product_id, 'person_id' => $user_id, "size_products_id" => $size_products_id]);
            }
        }
        return self::findProductInBasket($product_id, $user_id, $size_products_id);
    }

    public static function reduce($product_id, $user_id, $size_products_id)
    {
        $productInBasket = self::findProductInBasket($product_id, $user_id, $size_products_id);
        // var_dump($productInBasket);
        if ($productInBasket->quantity > 1) {
            $query =  Connection::make()->prepare('UPDATE baskets SET quantity=quantity-1 WHERE baskets.product_id=:product_id AND baskets.person_id=:person_id AND baskets.size_products_id=:size_products_id');
            $query->execute(['product_id' => $product_id, 'person_id' => $user_id, "size_products_id" => $size_products_id]);
        } else {
            $query =  Connection::make()->prepare('UPDATE baskets SET quantity=1 WHERE baskets.product_id=:product_id AND baskets.person_id=:person_id AND baskets.size_products_id=:size_products_id');
            $query->execute(['product_id' => $product_id, 'person_id' => $user_id, "size_products_id" => $size_products_id]);
        }
        return self::findProductInBasket($product_id, $user_id, $size_products_id);
    }

    public static function sum($user_id)
    {
        $query =  Connection::make()->prepare('SELECT SUM(products.price*baskets.quantity) as sum FROM baskets inner join products on baskets.product_id=products.id where baskets.person_id=:person_id');
        $query->execute(['person_id' => $user_id]);
        return $query->fetch(\PDO::FETCH_COLUMN); //получаем значение сразу
    }

    public static function count($user_id)
    {
        $query =  Connection::make()->prepare('SELECT SUM(quantity) as quantity FROM baskets where baskets.person_id=:person_id');
        $query->execute(['person_id' => $user_id]);
        return $query->fetch(\PDO::FETCH_COLUMN); //получаем значение сразу
    }

    public static function delete($product_id, $user_id)
    {
        $query =  Connection::make()->prepare('DELETE FROM baskets WHERE baskets.product_id=:product_id AND baskets.person_id=:person_id');
        $query->execute(['product_id' => $product_id, 'person_id' => $user_id]);
        return 'delete';
    }

    public static function clear($user_id, $conn = null)
    {
        $conn = $conn ?? Connection::make();

        $query =  $conn->prepare('DELETE FROM baskets WHERE baskets.person_id=:person_id');
        $query->execute(['person_id' => $user_id]);
        return 'clear';
    }
}
