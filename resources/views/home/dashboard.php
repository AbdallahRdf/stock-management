<?php
    require_once "../../../app/util/functions.php";

    session_start();
    if(!isset($_SESSION['user'])) // if not logged in redirect back to login page
    {
        view('auth.index');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    Welcome to Dashboard
</body>
</html>