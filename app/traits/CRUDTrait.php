<?php

namespace App\Traits;

use App\Core\Database;

trait CRUDTrait
{
    public static function all($id = null)
    {
        if (in_array(static::TABLE_NAME, ["categories", "clients", "suppliers"])) {
            $sql = "SELECT "
                . implode(", ", static::COLUMNS_TO_SHOW)
                . " FROM " . static::TABLE_NAME . " ORDER BY created_at DESC;";
        } else if (static::TABLE_NAME === "products") {
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
            ORDER BY products.created_at DESC;";
        } else if (in_array(static::TABLE_NAME, ["clientOrders", "supplierOrders"])) {
            $sql = "SELECT 
                " . static::TABLE_NAME . ".id, 
                " . static::TABLE_NAME . ".date, 
                " . static::TABLE_TO_JOIN . ".full_name as name 
            FROM " . static::TABLE_NAME . " JOIN " . static::TABLE_TO_JOIN . " 
            WHERE " . static::TABLE_NAME . "." . static::TRADE_PARTNER_ID . " = " . static::TABLE_TO_JOIN . ".id 
            ORDER BY " . static::TABLE_NAME . ".date DESC;";
        } else if (in_array(static::TABLE_NAME, ["clientOrderedProducts", "supplierOrderedProducts"])) {
            $sql = "SELECT 
                " . static::TABLE_NAME . ".id, 
                products.name as product_name,
                " . static::TABLE_NAME . ".quantity
            FROM " . static::TABLE_NAME . " JOIN products 
            WHERE " . static::TABLE_NAME . ".product_id = products.id and " . static::TABLE_NAME . ".order_id=:order_id
            Order BY " . static::TABLE_NAME . ".created_at DESC;";

            $params = [':order_id' => $id];
        }

        return (new Database)->query($sql, $params ?? null);
    }

    public static function paginate($offset = 0, $limit = 10, $id = null)
    {
        if (in_array(static::TABLE_NAME, ["categories", "clients", "suppliers"])) {
            $sql = "SELECT "
                . implode(", ", static::COLUMNS_TO_SHOW)
                . " FROM " . static::TABLE_NAME . " ORDER BY created_at DESC LIMIT $limit OFFSET $offset;";
        } else if (static::TABLE_NAME === "products") {
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
            ORDER BY products.created_at DESC LIMIT $limit OFFSET $offset;";
        } else if (in_array(static::TABLE_NAME, ["clientOrders", "supplierOrders"])) {
            $sql = "SELECT 
                " . static::TABLE_NAME . ".id, 
                " . static::TABLE_NAME . ".date, 
                " . static::TABLE_TO_JOIN . ".full_name as name 
            FROM " . static::TABLE_NAME . " JOIN " . static::TABLE_TO_JOIN . " 
            WHERE " . static::TABLE_NAME . "." . static::TRADE_PARTNER_ID . " = " . static::TABLE_TO_JOIN . ".id 
            ORDER BY " . static::TABLE_NAME . ".date DESC LIMIT $limit OFFSET $offset;";
        } else if (in_array(static::TABLE_NAME, ["clientOrderedProducts", "supplierOrderedProducts"])) {
            $sql = "SELECT 
                " . static::TABLE_NAME . ".id, 
                products.name as product_name,
                " . static::TABLE_NAME . ".quantity
            FROM " . static::TABLE_NAME . " JOIN products 
            WHERE " . static::TABLE_NAME . ".product_id = products.id and " . static::TABLE_NAME . ".order_id=:order_id
            Order BY " . static::TABLE_NAME . ".created_at DESC LIMIT $limit OFFSET $offset;";

            $params = [':order_id' => $id];
        }

        return (new Database)->query($sql, $params ?? null);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM " . static::TABLE_NAME . " WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }
}
