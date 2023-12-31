<?php

namespace App\Models;

use App\Core\Database;

class SupplierOrder extends Order
{
    const TABLE_NAME = "supplierOrders";
    const TABLE_TO_JOIN = "suppliers";
    const TRADE_PARTNER_ID = "supplier_id";

    // get the supplier of the order
    public static function get_supplier($supplierOrder_id)
    {
        $sql = "SELECT suppliers.id, full_name, email, phone_num, registration_date 
            FROM supplierOrders JOIN suppliers 
            WHERE suppliers.id = supplierOrders.supplier_id 
            and supplierOrders.id= :SupplierOrder_id";

        $params = [':SupplierOrder_id' => $supplierOrder_id];

        return (new Database)->query($sql, $params, false);
    }
}
