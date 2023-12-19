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
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO($this->dsn, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Erro {$e->getMessage()}";
        }
    }

    //* this method takes a query and an array of parameters, and executes it;
    public function query($sql, $params = null, $fetchAll = true)
    {
        try {
            // prepare the query
            $query = $this->db->prepare($sql);

            // execute the query
            $query->execute($params);

            return $fetchAll ? $query->fetchAll(PDO::FETCH_ASSOC) : $query->fetch(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e)
        {
            echo "Error occured while executing the query: {$e->getMessage()}";
        }
    }
}
