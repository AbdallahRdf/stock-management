<?php

namespace App\Models;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Database;
use PDOException;

class User
{
    // private $first_name;
    // private $last_name;
    // private $email;
    // private $password;

    // public function __construct($first_name, $last_name, $email, $password)
    // {
    //     $this->first_name = $first_name;
    //     $this->last_name = $last_name;
    //     $this->email = $email;
    //     $this->password = $password;
    // }

    //* create a new user
    public static function create_user($first_name, $last_name, $email, $password)
    {
        // check if there is already a user with with that email, then return true; 
        if(static::get_user($email)) return true;

        $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)";

        $params = [
            ":firstName" => $first_name,
            ":lastName" => $last_name,
            ":email" => $email,
            ":password" => $password
        ];
        (new Database)->query($sql, $params);
        return false;
    }

    public static function get_user($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $params = [
            ":email" => $email
        ];

        return (new Database)->query($sql, $params);
    }
}