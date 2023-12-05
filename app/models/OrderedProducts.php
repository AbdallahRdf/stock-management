<?php

namespace App\Models;

use App\Core\Database;

class OrderedProduct
{
    // returns all the ordered products in the db;
    public static function all($order_id)
    {
        $sql = "SELECT 
            orderedProducts.id,
            products.name as product_name,
            orderedProducts.quantity
        FROM orderedProducts JOIN products 
        WHERE orderedProducts.product_id = products.id and orderedProducts.order_id=:order_id
        ORDER BY orderedProducts.created_at DESC;";

        $params = [':order_id' => $order_id];

        return (new Database)->query($sql, $params);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($order_id, $offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            orderedProducts.id,
            products.name as product_name,
            orderedProducts.quantity
        FROM orderedProducts JOIN products 
        WHERE orderedProducts.product_id = products.id and orderedProducts.order_id=:order_id
        ORDER BY orderedProducts.created_at DESC;
        LIMIT $limit OFFSET $offset;";

        $params = [':order_id' => $order_id];

        return (new Database)->query($sql);
    }

    //create an ordered product
    public static function create($product_id, $quantity, $order_id)
    {
        $sql1 = "INSERT INTO orderedProducts (order_id,product_id,quantity) values (:order_id, :product_id, :quantity);";
        $params1 = [
            ":order_id" => $order_id,
            ":product_id" => $product_id,
            ":quantity" => $quantity,
        ];

        return (new Database)->query($sql1, $params1);
    }

    // delete an ordered product
    public static function delete($id)
    {
        $sql = "DELETE FROM orderedProducts WHERE id=:id";
        $params = [":id" => $id];
        return (new Database)->query($sql, $params);
    }


    // update an ordered product
    public static function update($id, $product_id, $quantity)
    {
        $sql = "UPDATE orderedProducts SET product_id=:product_id, quantity=:quantity  WHERE id=:id";

        $params = [
            ":product_id" => $product_id,
            ":quantity" => $quantity,
            ":id" => $id
        ];
        return (new Database)->query($sql, $params);
    }
}
