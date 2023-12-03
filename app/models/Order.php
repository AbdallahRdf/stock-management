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
            clients.full_name as client_name 
        FROM orders JOIN clients 
        WHERE orders.client_id = clients.id 
        ORDER BY orders.created_at DESC;";

        return (new Database)->query($sql);
    }

    public static function orderedProducts($order_id)
    {
        $sql = "SELECT 
        orderedProducts.id, 
        orderedProducts.quantity, 
        products.name as product_name 
    FROM orderedProducts JOIN products 
    WHERE orderedProducts.product_id = products.id and orderedProducts.order_id=:order_id
    ORDER BY orderedProducts.created_at DESC;";
        $params = [':order_id' => $order_id];

        return (new Database)->query($sql, $params);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            orders.id, 
            orders.date, 
            clients.full_name as client_name 
        FROM orders JOIN clients 
        WHERE orders.client_id = clients.id 
        ORDER BY orders.created_at DESC
        LIMIT $limit OFFSET $offset;";

        return (new Database)->query($sql);
    }

    // get the quantity of orders in each month
    public static function allGroupByMonth($year)
    {
        $sql = "select month(date), count(id) from orders where year(date) = :year group by month(date) order by month(date) asc;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    // create an order
    public static function create($date, $client_id)
    {
        $sql = "INSERT INTO orders (date, client_id) VALUES (:date, :client_id);";

        $params = [
            ":date" => $date,
            ":client_id" => $client_id,
        ];
        return (new Database)->query($sql, $params);
    }

    // gets the last inserted item
    public static function getLast()
    {
        $sql = "SELECT MAX(id) FROM orders";
        //$sql="SELECT * FROM orders ORDER BY DESC LIMIT 1";
        return (new Database)->query($sql);
    }

    // delete an order
    public static function delete($id)
    {
        $sql = "DELETE FROM orders WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update an order
    public static function update($id, $date, $client_id)
    {
        $sql = "UPDATE orders SET date=:date, client_id=:client_id  WHERE id=:id";

        $params = [
            ":date" => $date,
            ":client_id" => $client_id,
            ":id" => $id
        ];
        return (new Database)->query($sql, $params);
    }

    ////////////////////////////////////////:
    /////////////////////////////////////////

    //create an ordered product
    public static function createOrderedProduct($product_id, $quantity, $order_id)
    {
        $sql1 = "INSERT INTO orderedProducts (order_id,product_id,quantity) values (:order_id, :product_id, :quantity);";
        $params1 = [
            ":order_id" => $order_id,
            ":product_id" => $product_id,
            ":quantity" => $quantity,
        ];

        return (new Database)->query($sql1, $params1);
    }

    // delete an ordered product
    public static function deleteOrderedProduct($id)
    {
        $sql = "DELETE FROM orderedProducts WHERE id=:id";
        $params = [":id" => $id];
        return (new Database)->query($sql, $params);
    }


    // update an ordered product
    public static function updateOrderedProduct($id, $product_id, $quantity)
    {
        $sql = "UPDATE orderedProducts SET product_id=:product_id, quantity=:quantity  WHERE id=:id";

        $params = [
            ":product_id" => $product_id,
            ":quantity" => $quantity,
            ":id" => $id
        ];
        return (new Database)->query($sql, $params);
    }
}
