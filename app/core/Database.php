<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
 {
    // dsn: database server hostname
    private $dsn = "mysql:host=localhost;dbname=stock-management";
    private $user = "root";
    private $password = "";
    private static $db = null;
    
    public function __construct()
    {
        if(static::$db === null)
        {
            try {
                static::$db = new PDO($this->dsn, $this->user, $this->password);
                static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                echo "Connection Erro {$e->getMessage()}";
            }
        }
    }
    
    public function getConnection()
    {
        return static::$db;
    }
}
