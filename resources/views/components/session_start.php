<?php
session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    header('location: ../auth/index.php');
}