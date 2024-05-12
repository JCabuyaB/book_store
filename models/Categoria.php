<?php
namespace models;

use config\Database;

class Categoria{
    private $id;
    private $nombre_categoria;
    private $base_datos;

    public function __construct(){
        $this->base_datos  = Database::connect();
    }

    #region GETTERS Y SETTERS
    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    // categoria
    public function getNombre_categoria()
    {
        return $this->nombre_categoria;
    }

    public function setNombre_categoria($nombre_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;

        return $this;
    }
    #endregion

    #REGION CRUD
    public function crear_categoria(){

    }

    public function listar_categorias(){

    }

    public function actualizar_categorias(){

    }

    public function eliminar_categoria(){
        
    }
    #endregion
}