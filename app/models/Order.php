<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\DeleteTrait;

class Order
{
    use DeleteTrait;

    // returns all the orders in the db;
    public static function all()
    {
        $sql = "SELECT 
            " . static::TABLE_NAME . ".id, 
            " . static::TABLE_NAME . ".date, 
            " . static::TABLE_TO_JOIN . ".full_name as name 
        FROM " . static::TABLE_NAME . " JOIN " . static::TABLE_TO_JOIN . " 
        WHERE " . static::TABLE_NAME . "." . static::TRADE_PARTNER_ID . " = " . static::TABLE_TO_JOIN . ".id 
        ORDER BY " . static::TABLE_NAME . ".date DESC;";

        return (new Database)->query($sql);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            " . static::TABLE_NAME . ".id, 
            " . static::TABLE_NAME . ".date, 
            " . static::TABLE_TO_JOIN . ".full_name as name 
        FROM " . static::TABLE_NAME . " JOIN " . static::TABLE_TO_JOIN . " 
        WHERE " . static::TABLE_NAME . "." . static::TRADE_PARTNER_ID . " = " . static::TABLE_TO_JOIN . ".id 
        ORDER BY " . static::TABLE_NAME . ".date DESC
        LIMIT $limit OFFSET $offset;";

        return (new Database)->query($sql);
    }

    // create an order
    public static function create($date, $person_id)
    {
        $sql = "INSERT INTO " . static::TABLE_NAME . " (date, " . static::TRADE_PARTNER_ID . ") VALUES (:date, :trade_parter_id);";

        $params = [
            ":date" => $date,
            ":trade_parter_id" => $person_id,
        ];
        return (new Database)->query($sql, $params);
    }

    // update an order
    public static function update($id, $date, $person_id)
    {
        $sql = "UPDATE " . static::TABLE_NAME . " SET date=:date, " . static::TRADE_PARTNER_ID . "=:person_id  WHERE id=:id";

        $params = [
            ":date" => $date,
            ":person_id" => $person_id,
            ":id" => $id
        ];
        return (new Database)->query($sql, $params);
    }


    // get the quantity of orders in each month
    public static function allGroupByMonth($year)
    {
        $sql = "SELECT month(date) AS months, count(id) FROM " . static::TABLE_NAME . " 
            WHERE year(date) = :year 
            GROUP BY month(date) 
            ORDER BY month(date) ASC;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    // returns an array containing all the years of supplier orders
    public static function get_oldest_year()
    {
        $sql = "SELECT MIN(year(date)) AS min_year FROM " . static::TABLE_NAME . ";";
        return (new Database)->query($sql, null, false);
    }
}
