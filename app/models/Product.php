<?php

namespace App\models;

use App\helpers\Connection;

class Product
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT products.*, countries.name as country, brands.name as brand,categories.name as category FROM products
        INNER JOIN countries ON products.country_id=countries.id
        INNER JOIN brands ON products.brand_id=brands.id
        INNER JOIN categories ON products.category_id=categories.id");
        return $query->fetchAll();
    }
    public static function lastNewProducts()
    {
        $query = Connection::make()->query("SELECT id, photo, name FROM products
        ORDER BY products.id DESC
        LIMIT 5");
        return $query->fetchAll();
    }
    public static function updateCount($basket, $conn = null)
    {
        $conn = $conn ?? Connection::make();

        $query = $conn->prepare('UPDATE size_products SET quantity=quantity-:quantity  WHERE product_id=:product_id');
        foreach ($basket as $item) {
            $query->bindValue('quantity', $item->quantity, \PDO::PARAM_INT);
            $query->bindValue('product_id', $item->product_id, \PDO::PARAM_INT);
            $query->execute();
        }
    }
    public static function delete($id)
    {
        $query = Connection::make()->prepare("DELETE FROM products WHERE id = :id ");
        $query->execute(["id" => $id]);
        return "delete";
    }
    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT products.*, categories.name as category, brands.name as brand,countries.name as country, size_products.quantity as product_count FROM products
        INNER JOIN countries ON products.country_id=countries.id
        INNER JOIN categories ON products.category_id=categories.id
        INNER JOIN brands ON products.brand_id=brands.id
        INNER JOIN size_products ON size_products.product_id = products.id
        WHERE products.id=:id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
    public static function bootsAll()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=1");
        return $query->fetchAll();
    }

    public static function kipaAll()
    {
        $query = Connection::make()->query("SELECT products.id, products.name, products.photo, products.price FROM products
        WHERE products.category_id=2");
        return $query->fetchAll();
    }

    public static function kipaByBrand($id)
    {
        $query = Connection::make()->prepare("SELECT products.id, products.name, products.photo, products.price FROM products
        inner join brands on products.brand_id=brands.id
        WHERE brands.id=:id AND category_id=2");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }
    private static function getParam($array)
    {
        return implode(',', array_fill(0, count($array), '?'));
    }
    public static function productsByManyCategories($categories)
    {
        //формируем параметр запроса
        $param = self::getParam($categories);
        $query = Connection::make()->prepare("SELECT products.*, countries.name as country,brands.name as brand, categories.name as category FROM products
    INNER JOIN countries ON products.country_id=countries.id
    INNER JOIN categories ON products.category_id=categories.id
    INNER JOIN brands ON products.brand_id=brands.id
    WHERE category_id IN ($param)");
        $query->execute($categories);
        return $query->fetchAll();
    }

    public static function kipaByCountry($id)
    {
        $query = Connection::make()->prepare("SELECT products.id, products.name, products.photo, products.price FROM products
        inner join countries on products.country_id=countries.id
        WHERE countries.id=:id AND category_id=2");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public static function bootsByBrand($id)
    {
        $query = Connection::make()->prepare("SELECT products.id, products.name, products.photo, products.price FROM products
        inner join brands on products.brand_id=brands.id
        WHERE brands.id=:id AND category_id=1");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public static function bootsByCountry($id)
    {
        $query = Connection::make()->prepare("SELECT products.id, products.name, products.photo, products.price FROM products
        inner join countries on products.country_id=countries.id
        WHERE countries.id=:id AND category_id=1");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public static function searchProduct($name)
    {
        $query = Connection::make()->prepare("SELECT * FROM products WHERE name = :name");
        $query->execute([
            ':name' => $name
        ]);
        return $query->fetch();
    }

    public static function add($name, $price, $photo, $description, $year_release, $category_id, $brand_id, $country_id, $quantity, $table_size_id)
    {
        $conn = Connection::make();
        $product = self::searchProduct($name);
        if ($product == "") {
            $query = $conn->prepare("INSERT INTO products (name,price,photo,description,year_release,category_id,brand_id,country_id) VALUE (:name,:price,:photo,:description,:year_release,:category_id,:brand_id,:country_id)");
            $query->execute([
                ':name' => $name,
                ':price' => $price,
                ':photo' => $photo,
                ':description' => $description,
                ':year_release' => $year_release,
                ':category_id' => $category_id,
                ':brand_id' => $brand_id,
                ':country_id' => $country_id,
            ]);
            $product_id = $conn->lastInsertId();
            self::addSize($quantity, $table_size_id, $product_id);
        } else {
            self::addSize($quantity, $table_size_id, $product->id);
        }
    }

    public static function searchSize($table_size_id, $product_id)
    {
        $query = Connection::make()->prepare("SELECT * FROM size_products WHERE table_size_id = :table_size_id AND product_id = :product_id");
        $query->execute([
            ':table_size_id' => $table_size_id,
            ':product_id' => $product_id
        ]);
        return $query->fetch();
    }

    public static function addSize($quantity, $table_size_id, $product_id)
    {
        $size = self::searchSize($table_size_id, $product_id);
        if ($size == "") {
            $query = Connection::make()->prepare("INSERT INTO size_products (quantity,table_size_id,product_id) VALUE (:quantity,:table_size_id,:product_id)");
            $query->execute([
                ':quantity' => $quantity,
                ':table_size_id' => $table_size_id,
                ':product_id' => $product_id,
            ]);
        } else {
            $query = Connection::make()->prepare("UPDATE size_products SET quantity = quantity+:quantity");
            $query->execute([
                ':quantity' => $quantity
            ]);
        }
    }
    public static function updateQuantity($size_id, $quantity)
    {
        $query = Connection::make()->prepare("UPDATE size_products SET quantity=:quantity WHERE id = :id");
        $query->execute([
            ':quantity' => $quantity,
            ":id" => $size_id
        ]);
    }

    public static function update($data, $img)
    {
        $query = Connection::make()->prepare("UPDATE products SET name=:name ,price = :price, photo = :photo,description = :description, year_release = :year_release,category_id = :category_id,brand_id = :brand_id ,country_id = :country_id WHERE id = :id");
        $query->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':photo' => $img,
            ':description' => $data['description'],
            ':year_release' => $data['year_release'],
            ':category_id' => $data['category_id'],
            ':brand_id' => $data['brand_id'],
            ':country_id' => $data['country_id'],
            ':id' => $data['id']
        ]);
        self::updateQuantity($data["size_id"], $data["quantity"]);
    }
    public static function updateNoImage($data)
    {

        $query = Connection::make()->prepare("UPDATE products SET name=:name ,price = :price, description = :description, year_release = :year_release,category_id = :category_id,brand_id = :brand_id ,country_id = :country_id WHERE id = :id");
        $query->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':year_release' => $data['year_release'],
            ':category_id' => $data['category_id'],
            ':brand_id' => $data['brand_id'],
            ':country_id' => $data['country_id'],
            ':id' => $data['id'],

        ]);
        self::updateQuantity($data["size_id"], $data["quantity"]);
    }

    public static function search($name)
    {

        $query = Connection::make()->prepare("SELECT * FROM products WHERE products.name LIKE :name");
        $query->execute([
            ':name' => $name . "%"

        ]);

        return $query->fetchAll();
    }

    public static function filterBoots($country_id, $brand_id, $size_id, $sort){
        $queryBase = "SELECT DISTINCT products.id, products.name, products.photo, products.price, countries.name as country  FROM products
        inner join countries on products.country_id=countries.id inner join brands on products.brand_id=brands.id
        inner join size_products on products.id = size_products.product_id
        WHERE";
        $queryCountry="";
        $queryBrand="";
        $querySize="";
        $queryEnd ="";
        $values = [];
        if($country_id != ""){
            $queryCountry = " country_id = :country_id AND ";
            $values["country_id"]=$country_id;
        }
        if($brand_id != ""){
            $queryBrand = " products.brand_id = :brand_id AND ";
            $values["brand_id"]=$brand_id;
        }
        if($size_id != ""){
            $querySize = " size_products.table_size_id = :size_id  AND ";
            $values["size_id"]=$size_id;
        }
        if($sort != ""){
            $queryEnd = " category_id=1 " . $sort;
        }
        else{
            $queryEnd = " category_id=1";
        }
        
        $query = Connection::make()->prepare($queryBase.$queryCountry.$queryBrand.$querySize.$queryEnd);
        $query->execute($values);
        return $query->fetchAll();

    }

    public static function filterKipa($country_id, $brand_id, $size_id, $sort){
        $queryBase = "SELECT DISTINCT products.id, products.name as name, products.photo, products.price, countries.name as country  FROM products
        inner join countries on products.country_id=countries.id inner join brands on products.brand_id=brands.id
        inner join size_products on products.id = size_products.product_id
        WHERE";
        $queryCountry="";
        $queryBrand="";
        $querySize="";
        $queryEnd ="";
        $values = [];
        if($country_id != ""){
            $queryCountry = " country_id = :country_id AND ";
            $values["country_id"]=$country_id;
        }
        if($brand_id != ""){
            $queryBrand = " products.brand_id = :brand_id AND ";
            $values["brand_id"]=$brand_id;
        }
        if($size_id != ""){
            $querySize = " size_products.table_size_id = :size_id  AND ";
            $values["size_id"]=$size_id;
        }
        if($sort != ""){
            $queryEnd = " category_id=2 " . $sort;
        }
        else{
            $queryEnd = " category_id=2";
        }
        
        $query = Connection::make()->prepare($queryBase.$queryCountry.$queryBrand.$querySize.$queryEnd);
        $query->execute($values);
        return $query->fetchAll();

    }
    
}
