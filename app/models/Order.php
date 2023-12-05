<?php

namespace App\Models;

use App\Core\Database;

class Order
{
    // returns all the orders in the db;
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


    // get the quantity of orders in each month
    public static function allGroupByMonth($year)
    {
        $sql = "select month(date), count(id) from orders where year(date) = :year group by month(date) order by month(date) asc;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    // returns an array containing all the years of supplier orders
    public static function getAllYears()
    {
        return (new Database)->query("select distinct(year(date)) from orders order by year(date) desc");
    }

    // gets the last inserted item
    public static function getLast()
    {
        $sql = "SELECT MAX(id) FROM orders";
        //$sql="SELECT * FROM orders ORDER BY DESC LIMIT 1";
        return (new Database)->query($sql);
    }
}
