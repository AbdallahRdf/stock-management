<?php

namespace App\Models;

use App\Core\Database;

class OrderedProduct
{
    protected static $table_name;

    // get all the ordered products in the supplier order;
    public static function all($order_id)
    {
        $sql = "SELECT 
            ". static::$table_name .".id, 
            products.name as product_name,
            ". static::$table_name .".quantity
        FROM ". static::$table_name ." JOIN products 
        WHERE ". static::$table_name .".product_id = products.id and ". static::$table_name .".order_id=:order_id
        Order BY ". static::$table_name .".created_at DESC;";

        $params = [':order_id' => $order_id];

        return (new Database)->query($sql, $params);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($order_id, $offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            " . static::$table_name . ".id, 
            products.name as product_name,
            " . static::$table_name . ".quantity
        FROM " . static::$table_name . " JOIN products 
        WHERE " . static::$table_name . ".product_id = products.id and " . static::$table_name . ".order_id=:order_id
        Order BY " . static::$table_name . ".created_at DESC
        LIMIT {$limit} OFFSET {$offset};";

        $params = [':order_id' => $order_id];

        return (new Database)->query($sql, $params);
    }

    //create an Supplier Ordered product
    public static function create($product_id, $quantity, $order_id)
    {
        $sql = "INSERT INTO ". static::$table_name ." (order_id, product_id, quantity) values (:order_id, :product_id, :quantity);";

        $params = [
            ":order_id" => $order_id,
            ":product_id" => $product_id,
            ":quantity" => $quantity,
        ];

        return (new Database)->query($sql, $params);
    }

    // delete an Supplier Ordered product
    public static function delete($id)
    {
        $sql = "DELETE FROM ". static::$table_name ." WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update an Supplier Ordered product
    public static function update($id, $product_id, $quantity)
    {
        $sql = "UPDATE ". static::$table_name ." SET product_id=:product_id, quantity=:quantity  WHERE id=:id";

        $params = [
            ":product_id" => $product_id,
            ":quantity" => $quantity,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }
}
