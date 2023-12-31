<?php

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\User;

require_once "../app/util/functions.php";

/**
 * signup(): creates a new user with the passed params;
 * @return bool|array return false if the email is already used, and an array holding the user data if the user was created;
 */
function signup($first_name, $last_name, $email, $password)
{
    // check if there is already a user with that email, then return false; 
    if (User::get($email)) {
        return false;
    }
    // create a new user
    User::create([
        User::FIRST_NAME => $first_name,
        User::LAST_NAME => $last_name,
        User::EMAIL => $email,
        User::PASSWORD => $password
    ]);

    // return the new user data
    return User::get($email);
}

/**
 * this function checks if there is a user whith the passed credentials then return true, else false;
 * @return bool|array if there is a user with that email and tha password is true, return an array containing his data else return false;
 */
function login($email, $password)
{
    $user = User::get($email);

    //* if there is a user and the password is correct return the user data, else false;
    if ($user && password_verify($password, $user["password"])) {
        return $user;
    }
    return false;
}

// function send you back to login page
function go_back_to_login()
{
    // go to the login page;
    header("Location: ../resources/views/auth/index.php");
    die();
}

//* function that handles a login error;
function handle_login_error($email)
{
    $_SESSION['old'] = $email; // send back the email;
    $_SESSION['login_errors'] = true; // declare that there is a login error;

    go_back_to_login();
}

//* function that handles a signup error
function handle_signup_error($firstName, $lastName, $email, $ERRORS)
{
    $ERRORS["signup_errors"] = true; // declare that there is a signup error;

    // send back the old inputs data
    $OLD["firstName"] = $firstName;
    $OLD["lastName"] = $lastName;
    $OLD["email"] = $email;

    $_SESSION['old'] = $OLD;
    $_SESSION['signup_errors'] = $ERRORS;

    go_back_to_login();
}

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") // handle POST requests
{
    // extracting the variable;
    extract($_POST);

    // remove space before and after email and password
    $email = trim($email);
    $password = trim($password);

    // checking if we are in a signup process
    if (isset($_POST["first_name"])) {
        $ERRORS = []; // array to hold error for singup
        $OLD = []; // will hold the old inputs value;

        $first_name = trim($first_name);
        $last_name = trim($last_name);

        // checking if the email is valid
        if (empty($email) || !Validator::isEmailValid($email)) {
            $ERRORS["email_error"] = "Invalid Email Address";
        }
        // checking if the first name is valid
        if (!Validator::isStrValid($first_name)) {
            $ERRORS["firstName_error"] = "Invalid First Name";
        }

        // checking if the last name is valid
        if (!Validator::isStrValid($last_name)) {
            $ERRORS["lastName_error"] = "Invalid Last Name";
        }

        // checking if the password is valid
        $isPasswordValid = Validator::isPasswordValid($password);
        if ($isPasswordValid !== "valid") {
            $ERRORS["signup_password_error"] = $isPasswordValid;
        }

        if (!empty($ERRORS)) {
            handle_signup_error($first_name, $last_name, $email, $ERRORS);
        }

        $password = password_hash($password, PASSWORD_DEFAULT); // encrypting the user

        // $user: if the email is alredy used by another user will contain false
        $user = signup($first_name, $last_name, $email, $password);

        if (!$user) {
            $ERRORS["email_error"] = "Email is invalid or already taken";
            handle_signup_error($first_name, $last_name, $email, $ERRORS);
        }
        $_SESSION['user'] = $user;
    }
    // checking if we are in a login process
    else if (!isset($_POST["first_name"])) {
        // checking if the email is valid
        if (empty($email) || !Validator::isEmailValid($email)) {
            handle_login_error($email);
        }

        $user = login($email, $password);

        if (!$user) {
            handle_login_error($email);
        }
        $_SESSION['user'] = $user;
    }
    header("Location: DashboardController.php");
    die();
}
// if we have a user in session, then logout
if (isset($_SESSION['user'])) {
    unset($_SESSION);
    session_destroy();
}
//* redirect to login page;
go_back_to_login();
