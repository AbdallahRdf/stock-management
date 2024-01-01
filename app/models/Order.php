<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\CRUDTrait;

class Order
{
    use CRUDTrait;

    const DATE = "date";
    
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
