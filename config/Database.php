<?php
namespace config;
use mysqli;
use Exception;

class Database{
    private static $instance = null;
    private $connection;

    // generar conexion al crear objeto
    public function __construct()
    {
        $this->connection = new mysqli('localhost', 'root', '', 'book_store');
        
        if($this->connection->connect_error){
            throw new Exception("No se pudo establecer conexion a la base de datos" . $this->connection->connect_error);
        }else{
            $this->connection->query("SET NAMES 'utf8'");
        }
    }

    // generar instancia de el objeto
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // retornar conexion
    public function getConnection(){
        return $this->connection;
    }
}
