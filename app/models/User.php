<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\CRUDTrait;

class User
{
    use CRUDTrait;

    const TABLE_NAME = "users";
    const FIRST_NAME = "firstName";
    const LAST_NAME = "lastName";
    const EMAIL = "email";
    const PASSWORD = "password";
    //* create a new user
    // public static function create($first_name, $last_name, $email, $password)
    // {
    //     $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)";

    //     $params = [
    //         ":firstName" => $first_name,
    //         ":lastName" => $last_name,
    //         ":email" => $email,
    //         ":password" => $password
    //     ];
    //     return (new Database)->query($sql, $params);
    // }

    // get a user using email
    public static function get($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $params = [
            ":email" => $email
        ];

        return (new Database)->query($sql, $params, false);
    }

    // update the user
    public static function update($id, $first_name, $last_name)
    {
        $sql = "UPDATE users SET firstName = :firstName, lastName = :lastName WHERE id = :id";

        $params = [
            ":firstName" => $first_name,
            ":lastName"=> $last_name,
            ":id"=> $id
        ];

        return (new Database)->query($sql, $params);
    }

    // update the user's password
    public static function update_password($id, $password)
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        $params = [
            ":password" => $password,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }
}