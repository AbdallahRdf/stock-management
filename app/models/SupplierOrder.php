<?php

namespace App\Models;

use App\Core\Database;

class SupplierOrder
{
    // returns all the supplier orders in the db;
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

    // get the quantity of orders in each month
    public static function allGroupByMonth($year)
    {
        $sql = "SELECT month(date) as months, count(id) FROM supplierOrders 
            WHERE year(date) = :year 
            GROUP BY month(date) 
            ORDER BY month(date) ASC;";

        $params = [":year" => $year];

        return (new Database)->query($sql, $params);
    }

    // returns an array containing all the years of supplier orders
    public static function getAllYears()
    {
        return (new Database)->query("SELECT distinct(year(date)) AS years FROM supplierOrders ORDER BY year(date) DESC");
    }

    // gets the last inserted item
    public static function getLast()
    {
        $sql = "SELECT MAX(id) FROM supplierOrders";
        //$sql="SELECT * FROM supplierOrders SupplierOrder BY DESC LIMIT 1";
        return (new Database)->query($sql);
    }

    // get the supplier of the order
    public static function getSupplier($supplierOrder_id)
    {
        $sql = "SELECT 
        supplier_id
        FROM supplierOrders
        WHERE id= :SupplierOrder_id";

        $params = [':SupplierOrder_id' => $supplierOrder_id];

        return (new Database)->query($sql, $params);
    }
}
