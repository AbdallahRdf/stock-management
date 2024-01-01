<?php

namespace App\Models;

use App\Traits\CRUDTrait;

class OrderedProduct
{
    use CRUDTrait;

    const ORDER_ID = "order_id";
    const PRODUCT_ID = "product_id";
    const QUANTITY = "quantity";
}