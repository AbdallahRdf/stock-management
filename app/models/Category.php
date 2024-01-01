<?php

namespace App\Models;

use App\Traits\CRUDTrait;

class Category
{
    use CRUDTrait;

    const TABLE_NAME = "categories";
    const NAME = "name";
    const COLUMNS_TO_SHOW = ["id", "name"];
}