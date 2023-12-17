<?php

namespace App\Models;

use App\Core\Database;

class Order
{
    protected static $table_name; // table name (clientOrders or supplierOrder)
    protected static $joined_table; // table to join with (clients or suppliers)
    protected static $trade_partner_id; // either client_id or supplier_id

    // returns all the clientOrders in the db;
    public static function all()
    {
        $sql = "SELECT 
            " . static::$table_name . ".id, 
            " . static::$table_name . ".date, 
            " . static::$joined_table . ".full_name as name 
        FROM " . static::$table_name . " JOIN " . static::$joined_table . " 
        WHERE " . static::$table_name . "." . static::$trade_partner_id . " = " . static::$joined_table . ".id 
        ORDER BY " . static::$table_name . ".created_at DESC;";

        return (new Database)->query($sql);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            " . static::$table_name . ".id, 
            " . static::$table_name . ".date, 
            " . static::$joined_table . ".full_name as name 
        FROM " . static::$table_name . " JOIN " . static::$joined_table . " 
        WHERE " . static::$table_name . "." . static::$trade_partner_id . " = " . static::$joined_table . ".id 
        ORDER BY " . static::$table_name . ".created_at DESC
        LIMIT $limit OFFSET $offset;";

        return (new Database)->query($sql);
    }

    // create an order
    public static function create($date, $person_id)
    {
        $sql = "INSERT INTO " . static::$table_name . " (date, " . static::$trade_partner_id . ") VALUES (:date, :client_id);";

        $params = [
            ":date" => $date,
            ":client_id" => $person_id,
        ];
        return (new Database)->query($sql, $params);
    }

    // delete an order
    public static function delete($id)
    {
        $sql = "DELETE FROM " . static::$table_name . " WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update an order
    public static function update($id, $date, $person_id)
    {
        $sql = "UPDATE " . static::$table_name . " SET date=:date, " . static::$trade_partner_id . "=:person_id  WHERE id=:id";

        $params = [
            ":date" => $date,
            ":person_id" => $person_id,
            ":id" => $id
        ];
        return (new Database)->query($sql, $params);
    }


    // get the quantity of clientOrders in each month
    public static function allGroupByMonth($year)
    {
        $sql = "SELECT month(date) AS months, count(id) FROM " . static::$table_name . " 
            WHERE year(date) = :year 
            GROUP BY month(date) 
            ORDER BY month(date) ASC;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    // returns an array containing all the years of supplier clientOrders
    public static function getAllYears()
    {
        return (new Database)->query("SELECT distinct(year(date)) AS years FROM " . static::$table_name . " ORDER BY year(date) DESC");
    }

    // gets the last inserted item
    public static function getLast()
    {
        $sql = "SELECT MAX(id) FROM " . static::$table_name;

        return (new Database)->query($sql);
    }
}
