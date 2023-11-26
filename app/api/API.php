<?php

namespace App\API;

//* requiring the autoloader
require_once "../autoloader/autoloader.php";

use App\Models\Category;

class API
{
    public static function categories($offset, $limit)
    {
        return Category::paginate($offset, $limit);
    }
}