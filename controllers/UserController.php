<?php

namespace Controllers;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\User;

class UserController 
{
    public static function signup($first_name, $last_name, $email, $password)
    {
        (new User($first_name, $last_name, $email, $password))->create_user();
    }

    public static function login($email, $password)
    {

    }
}