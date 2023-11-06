<?php

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}


/** redirects you to a specific view.
 * @param string $view_name the view name to be redirected to, and it could also be in this format: folder_name.view_name
 * @param array $params optional params to send to the view through GET method
 * @return void
 */
function view($view_name, array $params = [])
{
    //* replacing "." with "/";
    if(str_contains($view_name,".")){
        str_replace(".","/", $view_name);
    }
    //* url
    $header_params = "location: /stock-management/resources/views/{$view_name}.php";
    
    //* add params whith the url
    if(!empty($params))
    {
        $queryParams = http_build_query($params);
        $header_params .= "?{$queryParams}";
    }
    header($header_params);
}


//* checks if the string does not contain any special chars;
function isStrValid($str)
{
    return preg_match("/^[a-zA-Z]*$/", $str);
}

//* checks if the email is valid;
function isEmailValid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

//* checks if the password is valid
function isPasswordValid($password)
{
    $message = "valid";
    if (strlen($password) < 8) {
        $message = "Your Password Must Contain At Least 8 Characters!";

    } elseif (!preg_match("/[0-9]+/", $password)) {
        $message = "Your Password Must Contain At Least 1 Number!";

    } elseif (!preg_match("/[A-Z]+/", $password)) {
        $message = "Your Password Must Contain At Least 1 Capital Letter!";

    } elseif (!preg_match("/[a-z]+/", $password)) {
        $message = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
    return $message;
}