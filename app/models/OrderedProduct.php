<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\CRUDTrait;

class OrderedProduct
{
    use CRUDTrait;

    // const ID = "id";
    const ORDER_ID = "order_id";
    const PRODUCT_ID = "product_id";
    const QUANTITY = "quantity";
    // const COLUMNS_TO_SHOW = [static::ID, static::QUANTITY];
    // const COLUMNS_FROM_JOINED_TABLE = ["name as product_name"];


    // get all the ordered products in the supplier order;
    // public static function all($order_id)
    // {
    //     $sql = "SELECT 
    //         ". static::TABLE_NAME .".id, 
    //         products.name as product_name,
    //         ". static::TABLE_NAME .".quantity
    //     FROM ". static::TABLE_NAME ." JOIN products 
    //     WHERE ". static::TABLE_NAME .".product_id = products.id and ". static::TABLE_NAME .".order_id=:order_id
    //     Order BY ". static::TABLE_NAME .".created_at DESC;";

    //     $params = [':order_id' => $order_id];

    //     return (new Database)->query($sql, $params);
    // }

    // Retrieves a paginated set of results from the database table.
    // public static function paginate($order_id, $offset = 0, $limit = 10)
    // {
    //     $sql = "SELECT 
    //         " . static::TABLE_NAME . ".id, 
    //         products.name as product_name,
    //         " . static::TABLE_NAME . ".quantity
    //     FROM " . static::TABLE_NAME . " JOIN products 
    //     WHERE " . static::TABLE_NAME . ".product_id = products.id and " . static::TABLE_NAME . ".order_id=:order_id
    //     Order BY " . static::TABLE_NAME . ".created_at DESC
    //     LIMIT {$limit} OFFSET {$offset};";

    //     $params = [':order_id' => $order_id];

    //     return (new Database)->query($sql, $params);
    // }

    //create an Supplier Ordered product
    // public static function create($product_id, $quantity, $order_id)
    // {
    //     $sql = "INSERT INTO ". static::TABLE_NAME ." (order_id, product_id, quantity) values (:order_id, :product_id, :quantity);";

    //     $params = [
    //         ":order_id" => $order_id,
    //         ":product_id" => $product_id,
    //         ":quantity" => $quantity,
    //     ];

    //     return (new Database)->query($sql, $params);
    // }

    // update an Supplier Ordered product
    public static function update($id, $product_id, $quantity)
    {
        $sql = "UPDATE ". static::TABLE_NAME ." SET product_id=:product_id, quantity=:quantity  WHERE id=:id";

        $params = [
            ":product_id" => $product_id,
            ":quantity" => $quantity,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }
}
