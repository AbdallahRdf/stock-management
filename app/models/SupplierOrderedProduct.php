<?php

namespace App\Models;

use App\Core\Database;

class SupplierOrderedProduct
{
    // get all the ordered products in the supplier order;
    public static function all($SupplierOrder_id)
    {
        $sql = "SELECT 
            supplierOrderedProducts.id, 
            products.name as product_name,
            supplierOrderedProducts.quantity
        FROM supplierOrderedProducts JOIN products 
        WHERE supplierOrderedProducts.product_id = products.id and supplierOrderedProducts.supplierOrder_id=:SupplierOrder_id
        Order BY supplierOrderedProducts.created_at DESC;";

        $params = [':SupplierOrder_id' => $SupplierOrder_id];

        return (new Database)->query($sql, $params);
    }

    // Retrieves a paginated set of results from the database table.
    public static function paginate($SupplierOrder_id, $offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            supplierOrderedProducts.id, 
            products.name as product_name,
            supplierOrderedProducts.quantity
        FROM supplierOrderedProducts JOIN products 
        WHERE supplierOrderedProducts.product_id = products.id and supplierOrderedProducts.supplierOrder_id=:SupplierOrder_id
        Order BY supplierOrderedProducts.created_at DESC;
        LIMIT {$limit} OFFSET {$offset};";

        $params = [':SupplierOrder_id' => $SupplierOrder_id];

        return (new Database)->query($sql, $params);
    }

    //create an Supplier Ordered product
    public static function create($product_id, $quantity, $SupplierOrder_id)
    {
        $sql = "INSERT INTO supplierOrderedProducts (supplierOrder_id,product_id,quantity) values (:SupplierOrder_id, :product_id, :quantity);";
        
        $params = [
            ":SupplierOrder_id" => $SupplierOrder_id,
            ":product_id" => $product_id,
            ":quantity" => $quantity,
        ];

        return (new Database)->query($sql, $params);
    }

    // delete an Supplier Ordered product
    public static function delete($id)
    {
        $sql = "DELETE FROM supplierOrderedProducts WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }


    // update an Supplier Ordered product
    public static function update($id, $product_id, $quantity)
    {
        $sql = "UPDATE supplierOrderedProducts SET product_id=:product_id, quantity=:quantity  WHERE id=:id";

        $params = [
            ":product_id" => $product_id,
            ":quantity" => $quantity,
            ":id" => $id
        ];
        
        return (new Database)->query($sql, $params);
    }
}
