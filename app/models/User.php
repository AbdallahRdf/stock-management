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
    public function save()
    {
        try {
            // get the connection
            $db = (new Database)->getConnection();
            // prepare the query
            $query = $db->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)");
            // execute the query
            $query->execute([
                ":firstName" => $this->first_name,
                ":lastName" => $this->last_name,
                ":email" => $this->email,
                ":password" => $this->password
            ]);
        } catch(PDOException $e) {
            echo "Error occured while signin up: {$e->getMessage()}";
        }
    }
}