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
}