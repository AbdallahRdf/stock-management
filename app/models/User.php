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

    // get a user using email
    public static function get($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $params = [
            ":email" => $email
        ];

        return (new Database)->query($sql, $params, false);
    }
}