<?php

namespace App\Models;

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
            products.excerpt,
            products.price, 
            products.stock_quantity, 
            categories.name as category_name 
        FROM products JOIN categories 
        WHERE products.category_id = categories.id 
        ORDER BY products.created_at DESC;";

        return (new Database)->query($sql);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            products.id, 
            products.name, 
            products.description, 
            products.excerpt,
            products.price, 
            products.stock_quantity, 
            categories.name as category_name 
        FROM products JOIN categories 
        WHERE products.category_id = categories.id 
        ORDER BY products.created_at DESC
        LIMIT {$limit} OFFSET {$offset};";

        return ((new Database)->query($sql));
    }

    // get One Product by its id :
    public static function getProduct($id)
    {
        $sql = "SELECT 
            products.id, 
            products.name, 
            products.description, 
            products.price, 
            products.stock_quantity, 
            categories.name as category_name 
        FROM products JOIN categories 
        WHERE products.category_id = categories.id and products.id=:id
        ORDER BY products.created_at DESC;";
        $params = [':id' => $id];

        return (new Database)->query($sql, $params);
    }
    // create a product
    public static function create($name, $excerpt, $description, $price, $quantity, $category)
    {
        $sql = "INSERT INTO products (name, excerpt, description, price, stock_quantity, category_id) VALUES (:name, :excerpt, :description, :price, :quantity, :category);";

        $params = [
            ":name" => $name,
            ":excerpt" => $excerpt,
            ":description" => $description,
            ":price" => $price,
            ":quantity" => $quantity,
            ":category" => $category
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

    // update a product
    public static function update($id, $name, $excerpt, $description, $price, $quantity, $category_id)
    {
        $sql = "UPDATE products SET name=:name, excerpt=:excerpt, description=:description, price=:price, stock_quantity=:quantity, category_id=:category_id WHERE id=:id";

        $params = [
            ":name" => $name,
            ":excerpt" => $excerpt,
            ":description" => $description,
            ":price" => $price,
            ":quantity" => $quantity,
            ":category_id" => $category_id,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }
}
