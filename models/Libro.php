<?php
namespace models;

use config\Database;

class Libro
{
    private $id;
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
        $connection = $this->base_datos->getConnection();
        return $this->$name = $connection->real_escape_string($value);
    }
    #endregion

    #region  CRUD
    public function crearLibro(){
        $query = "INSERT INTO tbl_libros VALUES(null, '{$this->__get('isbn')}', '{$this->__get('titulo')}', '{$this->__get('autor')}', '{$this->__get('sinopsis')}', '{$this->__get('imagen')}', {$this->__get('id_categoria')}, {$this->__get('id_editorial')}, {$this->__get('precio')}, {$this->__get('stock')});";

        $connection = $this->base_datos->getConnection();
        $save = $connection->query($query);

        $result = false;
        if($save & $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function listarLibros(){
        $query = "SELECT l.*, c.category_name 'categoria', e.editorial_name 'editorial' FROM tbl_libros l INNER JOIN tbl_categorias c ON c.id = l.id_cat INNER JOIN tbl_editoriales e ON e.id =  l.id_edit ORDER BY l.id DESC;";

        $connection = $this->base_datos->getConnection();
        $search = $connection->query($query);

        return $search;
    }

    public function actualizarLibro(){
        $query = "UPDATE tbl_libros SET isbn = '{$this->__get('isbn')}', title = '{$this->__get('titulo')}', autor = '{$this->__get('autor')}', synopsis = '{$this->__get('sinopsis')}', image = '{$this->__get('imagen')}', id_cat = {$this->__get('id_categoria')}, id_edit = {$this->__get('id_editorial')}, price = {$this->__get('precio')}, stock = {$this->__get('stock')} WHERE id = {$this->__get('id')};";

        $connection = $this->base_datos->getConnection();
        $update = $connection->query($query);

        $result = false;
        if($update && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function eliminarLibro(){
        $query = "DELETE FROM tbl_libros WHERE id = {$this->__get('id')}";

        $connection = $this->base_datos->getConnection();
        $delete = $connection->query($query);

        $result = false;
        if($delete && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function getLibro(){
        $query = "SELECT l.*, e.editorial_name, c.category_name FROM tbl_libros l INNER JOIN tbl_editoriales e ON l.id_edit = e.id INNER JOIN tbl_categorias c ON c.id = l.id_cat WHERE l.id = {$this->__get('id')};";

        $connection = $this->base_datos->getConnection();
        $select = $connection->query($query);

        $result = false;
        if($select && $select->num_rows  == 1){
            $result = $select->fetch_object();
        }

        return $result;
    }

    public function verifyImageExists(){
        $query = "SELECT * FROM tbl_libros WHERE image = '{$this->__get('imagen')}';";

        $connection = $this->base_datos->getConnection();
        $search = $connection->query($query);

        $result = false;
        if($search && $search->num_rows > 1){
            $result = true;
        }

        return $result;
    }
    #endregion
}
