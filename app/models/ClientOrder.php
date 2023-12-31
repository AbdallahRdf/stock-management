<?php

namespace App\Models;

class ClientOrder extends Order
{
    const TABLE_NAME = "clientOrders";
    const TABLE_TO_JOIN = "clients";
    const TRADE_PARTNER_ID = "client_id";
}
