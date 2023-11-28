<?php

namespace App\Models;

use App\Core\Database;

class Order
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT 
            orders.id, 
            orders.date, 
            clients.name as client_name 
        FROM orders JOIN clients 
        WHERE orders.client_id = clients.id 
        ORDER BY orders.created_at DESC;";

        return (new Database)->query($sql);
    }

    // Retrieves a paginated set of results from the database table.
    /*public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            products.id, 
            products.name, 
            products.excerpt,
            products.description, 
            products.price, 
            products.stock_quantity, 
            categories.name as category_name 
        FROM products JOIN categories 
        WHERE products.category_id = categories.id 
        ORDER BY products.created_at DESC
        LIMIT {$limit} OFFSET {$offset};";

        return ((new Database)->query($sql));
    }*/

    // create an order
    public static function create($date, $client_id,$product_id,$quantity)
    {
        $sql = "INSERT INTO orders (date, client_id) VALUES (:date, :client_id);";

        $params = [
            ":date" => $date,
            ":client_id" => $client_id,
        ];
        


        return (new Database)->query($sql, $params);
    }
    // gets the last inserted item
    public static function getLast(){
        $sql="SELECT MAX(id) FROM orders";
        return (new Database)->query($sql);
    }
    // delete a product
    public static function delete($id)
    {
        $sql = "DELETE FROM orders WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update a product
    public static function update($id, $date, $client_id, $product_id, $quantity)
    {
        $sql = "UPDATE products SET name=:name, excerpt=:excerpt, description=:description, price=:price, stock_quantity=:quantity, category_id=:category_id WHERE id=:id";

        $params = [
            ":name" => $name,
            ":excerpt" => $excerpt,
            ":description"=> $description,
            ":price"=> $price,
            ":quantity" => $quantity,
            ":category_id"=> $category_id,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }
}

?>