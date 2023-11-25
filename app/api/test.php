<?php

require_once "../util/functions.php";

//* requiring the autoloader
require_once "../autoloader/autoloader.php";

use App\Models\Category;

header('Content-Type: application/json');

echo json_encode(Category::all());