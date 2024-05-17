<?php
namespace models;

use config\Database;

class Editorial{
    private $id;
    private $nombre_editorial;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = Database::getInstance();
    }

    #region GETTERS Y SETTERS
    public function __set($name, $value){
        return $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }
    #endregion

    #region CRUD
    public function crearEditorial(){
        $query = "INSERT INTO tbl_editoriales VALUES(null, '{$this->__get('nombre_editorial')}');";

        $connection = $this->base_datos->getConnection();
        $insert = $connection->query($query);

        $result = false;
        if($insert && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function actualizarEditorial(){
        $query = "UPDATE tbl_editoriales SET editorial_name = '{$this->__get('nombre_editorial')}' WHERE id = {$this->__get('id')};";

        $connection = $this->base_datos->getConnection();
        $update = $connection->query($query);

        $result = false;
        if($update && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function listarEditoriales(){
        $query = "SELECT * FROM tbl_editoriales;";

        $connection = $this->base_datos->getConnection();
        $lista = $connection->query($query);

        return $lista;
    }

    public function eliminarEditorial(){
        $query = "DELETE FROM tbl_editoriales WHERE id = {$this->__get('id')};";

        $connection = $this->base_datos->getConnection();
        $delete = $connection->query($query);

        $result = false;
        if($delete && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }
    #rndregion
}