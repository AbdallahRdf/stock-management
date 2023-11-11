<?php

namespace App\Models;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Database;

class Product
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT 
            products.id, 
            products.name, 
            products.description, 
            products.price, 
            products.stock_quantity, 
            categories.name as category_name 
        FROM products JOIN categories WHERE products.category_id = categories.id";

        return (new Database)->query($sql);
    }
}