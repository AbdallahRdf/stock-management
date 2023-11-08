<?php

namespace App\Models;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Database;
use PDOException;

class User
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;

    public function __construct($first_name, $last_name, $email, $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }

    //* create a new user
    public function create_user()
    {
        $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)";

        $params = [
            ":firstName" => $this->first_name,
            ":lastName" => $this->last_name,
            ":email" => $this->email,
            ":password" => $this->password
        ];
        (new Database)->query($sql, $params);
    }

    public static function get_user($email, $password)
    {

    }
}