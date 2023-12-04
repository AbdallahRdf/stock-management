<?php

namespace App\Models;

use App\Core\Database;

class SupplierOrder
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT 
            supplierOrders.id, 
            supplierOrders.date, 
            suppliers.full_name as supplier_name 
        FROM supplierOrders JOIN suppliers 
        WHERE supplierOrders.supplier_id = suppliers.id 
        ORDER BY supplierOrders.created_at DESC;";

        return (new Database)->query($sql);
    }

<<<<<<< HEAD
    // get the quantity of orders in each month
    public static function allGroupByMonth($year)
    {
        $sql = "select month(date), count(id) from supplierOrders where year(date) = :year group by month(date) order by month(date) asc;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    public static function SupplierOrderedProducts($SupplierOrder_id)
=======
    public static function supplierOrderedProducts($SupplierOrder_id)
>>>>>>> 9ada7cb158cc14e4f75d7c8d2c6d2bda5bd216ba
    {
        $sql = "SELECT 
        supplierOrderedProducts.id, 
        supplierOrderedProducts.quantity, 
        products.name as product_name 
    FROM supplierOrderedProducts JOIN products 
    WHERE supplierOrderedProducts.product_id = products.id and supplierOrderedProducts.supplierOrder_id=:SupplierOrder_id
    Order BY supplierOrderedProducts.created_at DESC;";
        $params = [':SupplierOrder_id' => $SupplierOrder_id];

        return (new Database)->query($sql, $params);
    }
    // Retrieves a paginated set of results from the database table.
    public static function paginate($offset = 0, $limit = 10)
    {
        $sql = "SELECT 
            supplierOrders.id, 
            supplierOrders.date, 
            suppliers.full_name as supplier_name 
        FROM supplierOrders JOIN suppliers 
        WHERE supplierOrders.supplier_id = suppliers.id 
        ORDER BY supplierOrders.created_at DESC
        LIMIT {$limit} OFFSET {$offset};";

        return ((new Database)->query($sql));
    }

    // create an SupplierOrder
    public static function create($date, $supplier_id)
    {
        $sql = "INSERT INTO supplierOrders (date, supplier_id) VALUES (:date, :supplier_id);";

        $params = [
            ":date" => $date,
            ":supplier_id" => $supplier_id,
        ];
        return (new Database)->query($sql, $params);
    }

    // gets the last inserted item
    public static function getLast()
    {
        $sql = "SELECT MAX(id) FROM supplierOrders";
        //$sql="SELECT * FROM supplierOrders SupplierOrder BY DESC LIMIT 1";
        return (new Database)->query($sql);
    }

    // delete an SupplierOrder
    public static function delete($id)
    {
        $sql = "DELETE FROM supplierOrders WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }

    // update an SupplierOrder
    public static function update($id, $date, $supplier_id)
    {
        $sql = "UPDATE supplierOrders SET date=:date, supplier_id=:supplier_id  WHERE id=:id";

        $params = [
            ":date" => $date,
            ":supplier_id" => $supplier_id,
            ":id" => $id
        ];
        return (new Database)->query($sql, $params);
    }

    ////////////////////////////////////////:
    /////////////////////////////////////////

    //create an SupplierOrdered product
    public static function createSupplierOrderedProduct($product_id, $quantity, $SupplierOrder_id)
    {
        $sql1 = "INSERT INTO supplierOrderedProducts (supplierOrder_id,product_id,quantity) values (:SupplierOrder_id, :product_id, :quantity);";
        $params1 = [
            ":SupplierOrder_id" => $SupplierOrder_id,
            ":product_id" => $product_id,
            ":quantity" => $quantity,
        ];

        return (new Database)->query($sql1, $params1);
    }

    // delete an SupplierOrdered product
    public static function deleteSupplierOrderedProduct($id)
    {
        $sql = "DELETE FROM supplierOrderedProducts WHERE id=:id";
        $params = [":id" => $id];
        return (new Database)->query($sql, $params);
    }


    // update an SupplierOrdered product
    public static function updateSupplierOrderedProduct($id, $product_id, $quantity)
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
