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
     * @return bool|array return false if the email is already used, and an array holding the user data if the user was created;
     */
    public static function signup($first_name, $last_name, $email, $password)
    {
        // check if there is already a user with with that email, then return false; 
        if(USER::get_user($email)) return false;

        // create a new user
        User::create_user($first_name, $last_name, $email, $password);
        
        // return the new user data
        return User::get_user($email)[0];
    }

    /**
     * this function checks if there is a user whith the passed credentials then return true, else false;
     * @param string $email email of the user
     * @param string $password password of the user
     * @return bool|array if there is a user with that email and tha password is true, return an array containing his data else return false;
     */
    public static function login($email, $password)
    {
        $user = User::get_user($email);

        //* if there is a user and the password is correct return the user data, else false;
        if(count($user) > 0 && password_verify($password, $user[0]["password"]))
        {
            return $user[0];
        }
        return false;
    }
}