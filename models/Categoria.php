<?php
namespace models;

use config\Database;

class Categoria{
    private $id;
    private $nombre_categoria;
    private $base_datos;

    public function __construct(){
        $this->base_datos = Database::getInstance();
    }

    #region GETTERS Y SETTERS
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        return $this->$name = $value;
    }
    #endregion

    #REGION CRUD
    public function crearCategoria(){
        $query = "INSERT INTO tbl_categorias VALUES(null, '{$this->__get('nombre_categoria')}');";

        $connection = $this->base_datos->getConnection();
        $insert = $connection->query($query);

        $result = false;
        if($insert && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function listarCategorias(){
        $query = "SELECT * FROM tbl_categorias ORDER BY id DESC;";

        $connection = $this->base_datos->getConnection();
        $result = $connection->query($query);

        return $result;
    }

    public function actualizarCategoria(){
        $query = "UPDATE tbl_categorias SET category_name = '{$this->__get('nombre_categoria')}' WHERE id = {$this->__get('id')};";

        $connection = $this->base_datos->getConnection();
        $update = $connection->query($query);

        $result = false;
        if($update && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function eliminarCategoria(){
        $query = "DELETE FROM tbl_categorias WHERE id = {$this->__get('id')};";

        $connection = $this->base_datos->getConnection();
        $delete = $connection->query($query);

        $result = false;
        if($delete && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }
    #endregion
}