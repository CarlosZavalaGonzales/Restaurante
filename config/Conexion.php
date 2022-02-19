<?php


class ClsConexion
{
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = ''; 
    protected $db_driver    = 'mysql';
    protected $db_name      = 'restaurante';
    protected $query;
    protected $rows = array();
    private $conn;
   
    protected $hasActiveTransaction = false;

    private function open_connection()
    {
        $cadena=$this->db_driver.":host=".self::$db_host.";dbname=" .$this->db_name;
        $this->conn = new PDO($cadena,self::$db_user,self::$db_pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->query("SET NAMES 'utf8'");
    }
    private function close_connection()
    {
        $this->conn = null;
    }
    protected function execute_single_query()
    {
        if( $this->hasActiveTransaction==false)
            $this->open_connection();
        $stm = $this->conn->prepare($this->query);
        $stm->execute();
    }
    protected function get_results_from_query()
    {
        $this->open_connection();
        $stm = $this->conn->prepare($this->query);
        $stm->execute() ;
        $this->rows= array("cuerpo"=> $stm->fetchAll());
        var_dump($this->rows);
        $this->close_connection();
    }
    protected function execute_query()
    {
        if( $this->hasActiveTransaction==false)
            $this->open_connection();

        $stm = $this->conn->prepare($this->query);
        if($stm->execute())
        {
            $this->rows= $stm->fetchAll(PDO::FETCH_ASSOC);
            // revisar https://es.stackoverflow.com/questions/184341/diferencia-entre-fetch-y-fetchall-en-php
        }
    }
    
    public function beginTransaction()
    {
        if( $this->hasActiveTransaction==false)
        {
            $this->open_connection();
            $this->conn->beginTransaction();
            $this->hasActiveTransaction = true ;
        }
    }
   
    public function commit()
    {
        $this->conn->commit ();
        $this->hasActiveTransaction = false;
        $this->close_connection();
    }
    
    public function rollback()
    {
        $this->conn->rollback ();
        $this->hasActiveTransaction = false;
        $this->close_connection();
    }

}