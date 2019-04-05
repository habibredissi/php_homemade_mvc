<?php

class Model
{
    private $DB;

    public function __construct()
    {
        $instance = Database::getInstance();
        $this->DB = $instance->getConnection();
    }

    public function getDB()
    {
        
        return $this->DB;
    }

    public function getLastID()
    {
        return $this->DB->lastInsertId();
    }
}