<?php

namespace App\Models;

use App\Core\Database;

class ClientOrderedProduct extends OrderedProduct
{
    const TABLE_NAME = "clientOrderedProducts";

    // Retrieves the top-selling products by summing their quantities from all orders.
    public static function get_top_selling_products($limit = 5)
    {
        $sql = "SELECT products.name, sum(clientOrderedProducts.quantity) AS quantity 
            FROM clientOrderedProducts JOIN products 
            WHERE products.id = clientOrderedProducts.product_id 
            GROUP BY clientOrderedProducts.product_id 
            ORDER BY sum(clientOrderedProducts.quantity) DESC
            LIMIT $limit;";

        return (new Database)->query($sql);
    }
}
