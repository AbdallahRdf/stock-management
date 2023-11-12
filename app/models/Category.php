<?php

namespace App\Models;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Database;

class Category
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT * FROM categories";

        return (new Database)->query($sql);
    }

    // creates new category;
    public static function create_category($name)
    {
        $sql = "INSERT INTO categories(name) VALUES (:name);";

        $params = [":name" => $name];

        return (new Database)->query($sql, $params);
    }
}