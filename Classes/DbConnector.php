<?php

namespace Classes;

use PDO;
use PDOException;

class DbConnector
{

    private $host = "localhost";
    private $dbname = "db1";
    private $dbuser = "root";
    private $dbpw = "";

    public function getConnection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        try {
            $con = new PDO($dsn, $this->dbuser, $this->dbpw);
            return $con;
        } catch (PDOException $exc) {
            die("ERROR: " . $exc->getMessage());
        }
    }
}
