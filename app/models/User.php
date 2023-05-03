<?php

namespace App\models;

use App\helpers\Connection;

//можно разместить все методы для работы с таблицей юзерс
class User
{
    public static function connect($config = CONFIG_CONNECTION)
    {
        return Connection::make($config);
    }

    public static function getUser($phone, $password)
    {
        $query = self::connect()->prepare("SELECT * FROM persons WHERE persons.phone = :phone");
        $query->execute([':phone' => $phone]);
        $user = $query->fetch();
        if (password_verify($password, $user->password)) {
            return $user;
        };
        return null;
    }
    public static function find($id)
    {
        $query = self::connect()->prepare('SELECT persons.*, roles.name as role FROM persons
        INNER JOIN roles ON persons.role_id=roles.id WHERE persons.id=:id');
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public static function all()
    {
        $query = self::connect()->query("SELECT persons.id, persons.name as user, persons.surname, persons.middle_name, persons.phone,  roles.name as role, password FROM persons INNER JOIN roles ON persons.role_id = roles.id");
        return $query->fetchAll();
    }

    public static function insert($data)
    {
        $query = self::connect()->prepare("INSERT into persons (name, surname, middle_name, phone, password, role_id ) values (:name, :surname, :middle_name, :phone, :password, :role_id )");
        return $query->execute([
            ':name' => $data['name'],
            ':surname' => $data['surname'],
            ':middle_name' => $data['middle_name'],
            ':phone' => $data['phone'],
            ':role_id' => $data['role'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT) //захэшировали пароль
        ]);
    }

    public static function delete($id)
    {
        $query = self::connect()->prepare("DELETE FROM persons WHERE id = :id");
        return $query->execute([':id' => $id]);
    }

    public static function ordersUser($id)
    {
        $query = self::connect()->prepare("SELECT order_id, products.name, products.photo,product_in_orders.quantity, delivery.address,table_sizes.size, statuses.name as status, products.price as price_product_order, orders.date_order from product_in_orders
        inner join orders on product_in_orders.order_id=orders.id
        inner join size_products on product_in_orders.size_product_id=size_products.id
        INNER join table_sizes on size_products.table_size_id=table_sizes.id
        inner join products on product_in_orders.product_id=products.id
        inner join delivery on orders.delivery_id=delivery.id
        inner join statuses on orders.status_id=statuses.id
        
        where person_id=:id");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }
    public static function ordersUserProducts($id)
    {
        $query = self::connect()->prepare("SELECT orders.id, orders.date_order, delivery.address, statuses.name as status,(SELECT SUM(product_in_orders.quantity * (SELECT price FROM products WHERE product_in_orders.product_id = products.id)) FROM product_in_orders WHERE product_in_orders.order_id = orders.id) as sum  from orders
        inner join statuses on orders.status_id=statuses.id
        inner join delivery on orders.delivery_id=delivery.id
        where person_id=:id");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }
}
