<?php

namespace Core;

use PDO;

class Database
 {
    // dsn: database server hostname
    private $dsn = "mysql:host=localhost;db_name=stock-management";
    private $user = "root";
    private $password = "";
    private static $db = null;
    
    public function __construct()
    {
        $this->db = new PDO($this->dsn, $this->user, $this->password);
    }

    public static function getConnection()
    {
        return static::$db;
    }
}
