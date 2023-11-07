<?php

namespace Controllers;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\User;

class UserController 
{
    public static function signup($firstName, $lastName, $email, $password)
    {
        $user = new User($firstName, $lastName, $email, $password);
        $user->save();
    }
}