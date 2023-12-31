<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\CRUDTrait;

class Product
{
    use CRUDTrait;

    const TABLE_NAME = "products";
    // const ID = "id";
    // const NAME = "name";
    // const DESCRIPTION = "description";
    // const EXCERPT = "excerpt";
    // const PURCHASE_PRICE = "purchase_price";
    // const SELLING_PRICE = "selling_price";
    // const STOCK_QUANTITY = "stock_quantity";
    // const COLUMNS_TO_SHOW = [
    //     static::ID,
    //     static::NAME,
    //     static::DESCRIPTION,
    //     static::EXCERPT,
    //     static::PURCHASE_PRICE,
    //     static::SELLING_PRICE,
    //     static::STOCK_QUANTITY
    // ];
    // const COLUMNS_FROM_JOINED_TABLE = ["full_name as name"];

    // returns all the categories in the db;
    // public static function all()
    // {
    //     $sql = "SELECT 
    //         products.id, 
    //         products.name, 
    //         products.description,
    //         products.excerpt, 
    //         products.purchase_price, 
    //         products.selling_price,
    //         products.stock_quantity,
    //         suppliers.full_name as supplier_name,
    //         categories.name as category_name 
    //     FROM products 
    //     JOIN categories ON products.category_id = categories.id 
    //     JOIN suppliers ON products.supplier_id = suppliers.id  
    //     ORDER BY products.created_at DESC;";

    //     return (new Database)->query($sql);
    // }

    // Retrieves a paginated set of results from the database table.
    // public static function paginate($offset = 0, $limit = 10)
    // {
    //     $sql = "SELECT 
    //         products.id, 
    //         products.name, 
    //         products.description,
    //         products.excerpt,  
    //         products.purchase_price, 
    //         products.selling_price,
    //         products.stck_quantity,
    //         suppliers.full_name as supplier_name,
    //         categories.name as category_name 
    //     FROM products 
    //     JOIN categories ON products.category_id = categories.id 
    //     JOIN suppliers ON products.supplier_id = suppliers.id 
    //     ORDER BY products.created_at DESC
    //     LIMIT {$limit} OFFSET {$offset};";

    //     return ((new Database)->query($sql));
    // }

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

        return (new Database)->query($sql, $params, false);
    }
    // create a product
    public static function create($name, $excerpt, $description, $purchase_price, $quantity, $category, $supplier, $selling_price)
    {
        $sql = "INSERT INTO products (name, excerpt, description, purchase_price, stock_quantity, category_id,supplier_id,selling_price) 
            VALUES (:name, :excerpt, :description, :purchase_price, :quantity, :category,:supplier,:selling_price);";

        $params = [
            ":name" => $name,
            ":excerpt" => $excerpt,
            ":description" => $description,
            ":purchase_price" => $purchase_price,
            ":quantity" => $quantity,
            ":category" => $category,
            ":supplier" => $supplier,
            ":selling_price" => $selling_price
        ];

        return (new Database)->query($sql, $params);
    }

    // update a product
    public static function update($id, $name, $excerpt, $description, $purchase_price, $quantity, $category_id, $supplier_id, $selling_price)
    {
        $sql = "UPDATE products SET name=:name, excerpt=:excerpt, description=:description, purchase_price=:purchase_price, stock_quantity=:quantity, category_id=:category_id, supplier_id=:supplier_id, selling_price=:selling_price WHERE id=:id";

        $params = [
            ":name" => $name,
            ":excerpt" => $excerpt,
            ":description" => $description,
            ":purchase_price" => $purchase_price,
            ":quantity" => $quantity,
            ":category_id" => $category_id,
            ":supplier_id" => $supplier_id,
            ":selling_price" => $selling_price,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }
    public static function updateQuantity($id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity=:quantity WHERE id=:id";

        $params = [
            ":quantity" => $quantity,
            ":id" => $id
        ];

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
