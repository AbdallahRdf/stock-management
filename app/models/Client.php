<?php

namespace App\Models;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Database;

class Client
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT * FROM clients";

        return (new Database)->query($sql);
    }

    // creates new client
    public static function create($name, $email, $phone_number, $date)
    {
        $sql = "INSERT INTO clients (full_name, email, phone_num, registration_date) VALUES (:name, :email, :phone, :date)";

        $params = [
            ":name" => $name,
            ":email"=> $email,
            ":phone"=> $phone_number,
            ":date"=> $date
        ];

        return (new Database)->query($sql, $params);
    }
}