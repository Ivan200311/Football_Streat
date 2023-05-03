<?php
namespace App\models;
use App\helpers\Connection;
use App\models\Basket;
use App\models\Product;

class Order
{
    public static function addOrder($user_id, $conn, $delivery_id)
    {
        $conn = $conn ?? Connection::make();
        $query = $conn->prepare('INSERT INTO orders (person_id, date_order, updated_at,delivery_id,status_id) VALUES (:person_id, :date_order, :updated_at, :delivery_id,1)');
        $query->execute([
            'person_id' => $user_id,
            'date_order' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'delivery_id' => $delivery_id
        ]);
        return $conn->lastInsertId();
    }

    public static function create($user_id, $delivery_id)
    {
        //получаем корзину пользователя
        $basket = Basket::allProductByUser($user_id);

        //устанавливаем подключение 
        $conn = Connection::make();

        //транзакция
        try {
            //открываем транзакцию
            $conn->beginTransaction();

            //1. добавляем новый заказ
            $order_id = self::addOrder($user_id, $conn, $delivery_id);

            //2. добавляем продукты в заказ
            self::addProductsInOrder($basket, $order_id, $conn);

            //3. корректируем кол-во продуктов на складе
            Product::updateCount($basket, $conn);

            //4. очистка корзины юзера
            Basket::clear($user_id, $conn);

            //5. принимаем транзакцию
            $conn->commit();
        } catch (\PDOException $error) {
            //откатываем транзакцию
            $conn->rollBack();
            echo ('Ошибка' . $error->getMessage());
        }
    }
    private static function getParam($array, $value)
    {
        return implode(',', array_fill(0, count($array), $value));
    }
    public static function addProductsInOrder($basket, $order_id, $conn)
    {
        $base = 'INSERT INTO product_in_orders (order_id, size_product_id, quantity, product_id) VALUES';
        $params = self::getParam($basket, '(?,?,?,?)');
        $queryText =  $base . $params;
        $values = []; //массив со значениями
        foreach ($basket as $item) {
            $values[] = $order_id;
            $values[] = $item->size_products_id;
            $values[] = $item->quantity;
            $values[] = $item->product_id;
        }
        $query = $conn->prepare($queryText);
        $query->execute($values);
    }
    public static function all()
    {
        $query = Connection::make()->prepare('SELECT orders.*, persons.phone as phone,persons.name as person_name, delivery.address as delivery, statuses.name as status, (SELECT SUM(quantity) FROM product_in_orders WHERE product_in_orders.order_id = orders.id) as count,(SELECT SUM(product_in_orders.quantity * (SELECT price FROM products WHERE product_in_orders.product_id = products.id)) FROM product_in_orders WHERE product_in_orders.order_id = orders.id) as sum FROM orders
        INNER JOIN persons ON orders.person_id=persons.id
        INNER JOIN statuses ON orders.status_id=statuses.id
        INNER JOIN delivery ON orders.delivery_id=delivery.id
        ORDER BY date_order DESC');
        $query->execute();
        return $query->fetchAll();

        //вывести кол-во товаров и общую стоимость в заказе
        //статус в виде выпадающего списка`
    }
    public static function AllOrderStatuses()
    {
        $query = Connection::make()->query("SELECT * FROM `statuses`");
        return $query->fetchAll();
    }
    public static function ordersByManyStatuses($status_id)
    {
        $query = Connection::make()->prepare("SELECT orders.*, persons.phone as phone,persons.name as person_name, delivery.address as delivery,statuses.name as status, (SELECT SUM(quantity) FROM product_in_orders WHERE product_in_orders.order_id = orders.id) as count,(SELECT SUM(product_in_orders.quantity * (SELECT price FROM products WHERE product_in_orders.product_id = products.id)) FROM product_in_orders WHERE product_in_orders.order_id = orders.id) as sum FROM orders
        INNER JOIN persons ON orders.person_id=persons.id
        INNER join delivery on orders.delivery_id=delivery.id
        INNER JOIN statuses ON orders.status_id=statuses.id WHERE orders.status_id=:id");
        $query->execute(['id' => $status_id]);
        return $query->fetchAll();
    }
    public static function shangeStatus($id, $status_id, $reason_cancel)
    {
        $query =  Connection::make()->prepare("UPDATE `orders` SET `status_id`=:status_id, `reason_cancel`=:reason_cancel, `updated_at`=:updated_at WHERE id=:id");
        $query->execute(["status_id" => $status_id, "reason_cancel" => $reason_cancel, "updated_at" => date("Y-m-d H:i:s"), "id" => $id]);
    }
    public static function productsByOrder($id)
    {
        $query = Connection::make()->prepare("SELECT product_in_orders.*,product_in_orders.quantity as product_count, table_sizes.size as size, orders.date_order, persons.name as pers_name, persons.phone as mail, products.name, products.price as price_product_order, products.photo as image FROM product_in_orders INNER JOIN size_products ON size_products.id = product_in_orders.size_product_id INNER JOIN table_sizes ON table_sizes.id = size_products.table_size_id INNER JOIN orders ON orders.id = product_in_orders.order_id INNER JOIN persons ON persons.id = orders.person_id INNER JOIN products ON products.id = product_in_orders.product_id WHERE product_in_orders.order_id = :id");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }
}
