<?php

namespace App\Models;

use App\Core\Database;

class Person
{
    // returns all the table records;
    public static function all()
    {
        $sql = "SELECT id, full_name, email, phone_num, registration_date FROM ". static::TABLE_NAME ." ORDER BY created_at DESC;";

        return (new Database)->query($sql);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT id, full_name, email, phone_num, registration_date FROM ". static::TABLE_NAME ." ORDER BY created_at DESC LIMIT {$limit} OFFSET {$offset};";

        return ((new Database)->query($sql));
    }

    // creates new supplier
    public static function create($name, $email, $phone_number, $date)
    {
        $sql = "INSERT INTO ". static::TABLE_NAME ." (full_name, email, phone_num, registration_date) VALUES (:name, :email, :phone, :date)";

        $params = [
            ":name" => $name,
            ":email" => $email,
            ":phone" => $phone_number,
            ":date" => $date
        ];

        return (new Database)->query($sql, $params);
    }

    // delete a supplier
    public static function delete($id)
    {
        $sql = "DELETE FROM ". static::TABLE_NAME ." WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update a supplier 
    public static function update($id, $name, $email, $phone_number, $date)
    {
        $sql = "UPDATE ". static::TABLE_NAME ." SET full_name=:name, email=:email, phone_num=:number, registration_date=:date WHERE id=:id";

        $params = [
            ":name" => $name,
            ":email" => $email,
            ":number" => $phone_number,
            ":date" => $date,
            ":id" => $id,
        ];

        return (new Database)->query($sql, $params);
    }
}