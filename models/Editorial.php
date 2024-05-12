<?php
namespace models;

use config\Database;

class Editorial{
    private $id;
    private $nombre_editorial;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = Database::connect();
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

    // editorial
    public function getNombre_editorial()
    {
        return $this->nombre_editorial;
    }

    public function setNombre_editorial($nombre_editorial)
    {
        $this->nombre_editorial = $nombre_editorial;

        return $this;
    }
    #endregion

    #region CRUD
    public function crear_editorial(){

    }

    public function listar_editoriales(){

    }

    public function actualizar_editorial(){

    }

    public function eliminar_editorial(){
        
    }
    #rndregion
}