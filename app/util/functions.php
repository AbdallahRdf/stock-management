<?php

function dd($data) // die and dump
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
function view($view_name)
{
    //* replacing "." with "/";
    if(str_contains($view_name,".")){
        $path = str_replace(".","/", $view_name);
    }

    header("location: ../../resources/views/{$path}.php");
    die();
}

// this function creates an alert session varaible, that will be used in the view to show an alert
function create_alert_session_variable($variable_name, $message)
{
    $_SESSION["alert"] = true;
    $_SESSION[$variable_name] = $message;
}

// return the current view name
function get_current_view()
{
    $array = explode("/", $_SERVER["PHP_SELF"]);
    $file_name = end($array);
    return explode(".", $file_name)[0];
}