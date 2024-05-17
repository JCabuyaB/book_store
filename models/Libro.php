<?php
namespace models;

use config\Database;

class Libro
{
    private $isbn;
    private $titulo;
    private $autor;
    private $sinopsis;
    private $imagen;
    private $id_categoria;
    private $id_editorial;
    private $precio;
    private $stock;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = Database::getInstance();
    }


    #region GETTERS Y  SETTERS
    public function __get($name){
        return $this->$name;
    }
    
    public function __set($name, $value){
        return $this->$name = $value;
    }
    #endregion

    #region  CRUD
    public function crearLibro(){
        $query = "INSERT INTO tbl_libros VALUES('{$this->__get('isbn')}', '{$this->__get('titulo')})', '{$this->__get('autor')}', '{$this->__get('sinopsis')}', '{$this->__get('imagen')}', {$this->__get('id_categoria')}, {$this->__get('id_editorial')}, {$this->__get('precio')}, {$this->__get('stock')};";

        $connection = $this->base_datos->getConnection();
        $save = $connection->query($query);

        $result = false;
        if($save & $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function listarLibros(){
        $query = "SELECT * FROM tbl_libros";

        $connection = $this->base_datos->getConnection();
        $search = $connection->query($query);

        return $search;
    }

    public function actualizarLibro(){
        $query = "UPDATE tbl_libros SET ISBN = ('{$this->__get('isbn')}', '{$this->__get('titulo')})', '{$this->__get('autor')}', '{$this->__get('sinopsis')}', '{$this->__get('imagen')}', {$this->__get('id_categoria')}, {$this->__get('id_editorial')}, {$this->__get('precio')}, {$this->__get('stock')};";
    }

    public function eliminar_libro(){
        
    }
    #endregion
}
