<?php

namespace App\Models;

class ClientOrder extends Order
{
    protected static $table_name = "clientOrders";
    protected static $joined_table = "clients";
    protected static $person_id = "client_id";
}
