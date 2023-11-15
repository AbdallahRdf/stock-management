<?php

namespace App\Models;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Database;

class Product
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT 
            products.id, 
            products.name, 
            products.description, 
            products.price, 
            products.stock_quantity, 
            categories.name as category_name 
        FROM products JOIN categories WHERE products.category_id = categories.id";

        return (new Database)->query($sql);
    }

    // create a product
    public static function create($name, $description, $price, $quantity, $category)
    {
        $sql = "INSERT INTO products (name, description, price, stock_quantity, category_id) VALUES (:name, :description, :price, :quantity, :category);";

        $params = [
            ":name" => $name,
            ":description" => $description,
            ":price"=> $price,
            ":quantity"=> $quantity,
            ":category"=> $category
        ];

        return (new Database)->query($sql, $params);
    }

    // delete a product
    public static function delete($id)
    {
        $sql = "DELETE FROM products WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }
}