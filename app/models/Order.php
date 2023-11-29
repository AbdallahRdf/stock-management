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
    
    public static function orderedProducts($order_id){
        $sql = "SELECT 
        orderedProducts.id, 
        orderedProducts.quantity, 
        products.name as product_name 
    FROM orderedProducts JOIN products 
    WHERE orderedProducts.product_id = products.id and orderedProducts.order_id=:order_id
    ORDER BY orderedProducts.created_at DESC;";
    $params=[':order_id'=> $order_id];

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
        $result=(new Database)->query($sql, $params);
        if(!$result){
            $sql1="INSERT INTO orderedProducts (order_id,product_id,quantity) values (:order_id, :product_id, :quantity);";
            $params1 = [
                ":order_id" => getLast(),
                ":product_id" => $product_id,
                ":quantity" => $quantity,
            ];
        }
        return (new Database)->query($sql1, $params1);  
    }
    // gets the last inserted item
    public static function getLast(){
        $sql="SELECT MAX(id) FROM orders";
        //$sql="SELECT * FROM orders ORDER BY DESC LIMIT 1";
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
    public static function update($id, $date, $client_id, $ordered_p_id ,$product_id, $quantity)
    {
        $sql = "UPDATE orders SET date=:date, client_id=:client_id  WHERE id=:id";

        $params = [
            ":date" => $date,
            ":client_id" => $client_id,
            ":id" => $id
        ];
        $result=(new Database)->query($sql, $params);
        if(!$result){
            $sql = "UPDATE orderedProducts SET product_id=:product_id, quantity=:quantity  WHERE id=:id";

        }
    }
}

?>