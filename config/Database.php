<?php
namespace config;
use mysqli;

class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'book_store');
        $db->query("SET NAMES 'utf8'");

        if($db->connect_error){
            die("No se pudo establecer conexion" . $db->connect_error);
        }

        return $db;
    }
}
