<?php

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\Category;

$cateogies = Category::all();

session_start();
$_SESSION["categories"] = $cateogies;

//* redirect to categories page;
header("Location: ../resources/views/pages/categories/index.php");
die();