<?php

namespace App\Traits;

use App\Core\Database;

trait CRUDTrait
{
    private static function get_query()
    {
        if (in_array(static::TABLE_NAME, ["categories", "clients", "suppliers"])) {
            $sql = "SELECT "
                . implode(", ", static::COLUMNS_TO_SHOW)
                . " FROM " . static::TABLE_NAME . " ORDER BY created_at DESC";
        } 
        else if (static::TABLE_NAME === "products") 
        {
            $sql = "SELECT 
                products.id, 
                products.name, 
                products.description,
                products.excerpt, 
                products.purchase_price, 
                products.selling_price,
                products.stock_quantity,
                suppliers.full_name as supplier_name,
                categories.name as category_name 
            FROM products 
            JOIN categories ON products.category_id = categories.id 
            JOIN suppliers ON products.supplier_id = suppliers.id  
            ORDER BY products.created_at DESC";
        } 
        else if (in_array(static::TABLE_NAME, ["clientOrders", "supplierOrders"])) 
        {
            $sql = "SELECT 
                " . static::TABLE_NAME . ".id, 
                " . static::TABLE_NAME . ".date, 
                " . static::TABLE_TO_JOIN . ".full_name as name 
            FROM " . static::TABLE_NAME . " JOIN " . static::TABLE_TO_JOIN . " 
            WHERE " . static::TABLE_NAME . "." . static::TRADE_PARTNER_ID . " = " . static::TABLE_TO_JOIN . ".id 
            ORDER BY " . static::TABLE_NAME . ".date DESC";
        } 
        else if (in_array(static::TABLE_NAME, ["clientOrderedProducts", "supplierOrderedProducts"])) 
        {
            $sql = "SELECT 
                " . static::TABLE_NAME . ".id, 
                products.name as product_name,
                " . static::TABLE_NAME . ".quantity
            FROM " . static::TABLE_NAME . " JOIN products 
            WHERE " . static::TABLE_NAME . ".product_id = products.id and " . static::TABLE_NAME . ".order_id=:order_id
            Order BY " . static::TABLE_NAME . ".created_at DESC";
        }
        return $sql;
    }

    public static function all($id = null)
    {
        $params = ($id !== null) ? [':order_id' => $id] : null;

        return (new Database)->query(static::get_query(), $params);
    }

    public static function paginate($offset = 0, $limit = 10, $id = null)
    {
        $sql = static::get_query() . " LIMIT $limit OFFSET $offset;";

        $params = ($id !== null) ? [':order_id' => $id] : null;

        return (new Database)->query($sql, $params);
    }

    public static function create($assoc_array)
    {
        // turn the keys of the assoc_array to named parameters for the sql query
        $named_params_array = array_map(fn($col) => ":$col", array_keys($assoc_array));

        $sql = "INSERT INTO " 
                .static::TABLE_NAME
                ."("
                .implode(", ", array_keys($assoc_array))
                .") VALUES ("
                .implode(", ", $named_params_array)
                .");";
        
        $params = array_combine($named_params_array, array_values($assoc_array));

        return (new Database)->query($sql, $params);
    }

    public static function update($id, $assoc_array)
    {
        $sql = "UPDATE "
            . static::TABLE_NAME
            . " SET "
            . implode(", ", array_map(fn($col) => "$col = :$col", array_keys($assoc_array)))
            . " WHERE id = :id";

        $params = array_merge(
            [":id" => $id],
            array_combine(
                array_map(fn($col) => ":$col", array_keys($assoc_array)), 
                array_values($assoc_array)
            )
        );

        return (new Database)->query($sql, $params);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM " . static::TABLE_NAME . " WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }
}
