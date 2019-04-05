<?php

// Singleton to connect db

class Database {

    private static $instance = null;
    private $conn;
    
    // The db connection is established in the private constructor.
    private function __construct()
    {
      $this->conn = new PDO("mysql:host=" . HOST . ";
      dbname=" . DBNAME . "", USER, PASS,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    
    public static function getInstance()
    {
      if(!self::$instance)
      {
        self::$instance = new Database();
      }
     
      return self::$instance;
    }
    
    public function getConnection()
    {
      return $this->conn;
    }
  }

?>