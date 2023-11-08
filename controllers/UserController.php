<?php

namespace Controllers;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\User;

class UserController 
{
    /**
     * signup(): creates a new user with the passed params;
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @return bool return true if the email is already used, and flase if the user was created;
     */
    public static function signup($first_name, $last_name, $email, $password)
    {
        return User::create_user($first_name, $last_name, $email, $password);
    }

    /**
     * this function checks if there is a user whith the passed credentials then return true, else false;
     * @param string $email email of the user
     * @param string $password password of the user
     * @return bool
     */
    public static function login($email, $password)
    {
        $user = User::get_user($email);
        
        //* if there is a user and the password is correct return true, else false;
        return (count($user) > 0 && password_verify($password, $user[0]["password"]));
    }
}