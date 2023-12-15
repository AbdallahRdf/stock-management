<?php

namespace App\Models;

use App\Core\Database;

class Client extends Person
{
    protected static $table_name = "clients";

    // get the clients growth in each month
    public static function allGroupByMonth($year)
    {
        $sql = "SELECT month(registration_date) AS months, count(id) FROM clients 
            WHERE year(registration_date) = :year 
            GROUP BY month(registration_date) 
            ORDER BY month(registration_date) ASC;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    // returns an array containing all the years in clients
    public static function getAllYears()
    {
        return (new Database)->query("SELECT distinct(year(registration_date)) AS years FROM clients ORDER BY year(registration_date) DESC");
    }
}