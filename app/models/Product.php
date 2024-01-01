<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\CRUDTrait;

class Product
{
    use CRUDTrait;

    const TABLE_NAME = "products";

    const NAME = "name";
    const DESCRIPTION = "description";
    const EXCERPT = "excerpt";
    const PURCHASE_PRICE = "purchase_price";
    const SELLING_PRICE = "selling_price";
    const STOCK_QUANTITY = "stock_quantity";
    const CATEGORY_ID = "category_id";
    const SUPPLIER_ID = "supplier_id";

    // get One Product by its id :
    public static function get_product($id)
    {
        $sql = "SELECT 
            products.id, 
            products.name,
            products.excerpt,  
            products.description, 
            products.purchase_price, 
            products.selling_price,
            products.stock_quantity,
            suppliers.full_name as supplier_name,
            categories.name as category_name 
        FROM products 
        JOIN categories ON products.category_id = categories.id 
        JOIN suppliers ON products.supplier_id = suppliers.id 
        WHERE products.id = :id
        ORDER BY products.created_at DESC;";
        $params = [':id' => $id];

        return (new Database)->query($sql, $params);
    }

    //get products we got from a specific supplier
    public static function getProdsBySupp($supplier_id)
    {
        $sql = "SELECT 
            products.id, 
            products.name,
            products.excerpt,  
            products.description, 
            products.purchase_price, 
            products.selling_price,
            products.stock_quantity,
            suppliers.full_name as supplier_name,
            categories.name as category_name 
        FROM products JOIN categories ON products.category_id = categories.id 
        JOIN suppliers ON products.supplier_id = suppliers.id 
        WHERE suppliers.id = :supplier
        ORDER BY products.created_at DESC;";
        
        $params = [':supplier' => $supplier_id];

        return (new Database)->query($sql, $params);
    }
}
