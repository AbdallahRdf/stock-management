<?php

namespace App\Models;

use App\Core\Database;

class Client
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT id, full_name, email, phone_num, registration_date FROM clients ORDER BY created_at DESC;";

        return (new Database)->query($sql);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT id, full_name, email, phone_num, registration_date FROM clients ORDER BY created_at DESC LIMIT {$limit} OFFSET {$offset};";

        return ((new Database)->query($sql));
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

    // delete a client
    public static function delete($id)
    {
        $sql = "DELETE FROM clients WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update a client 
    public static function update($id, $name, $email, $phone_number, $date)
    {
        $sql = "UPDATE clients SET full_name=:name, email=:email, phone_num=:number, registration_date=:date WHERE id=:id";

        $params = [
            ":name"=> $name,
            ":email"=> $email,
            ":number" => $phone_number,
            ":date"=> $date,
            ":id"=> $id,
        ];

        return (new Database)->query($sql, $params);
    }
}