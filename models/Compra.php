<?php
namespace models;

use config\Database;

class Compra{
    private $codigo;
    private $id_usuario;
    private $fecha_venta;
    private $estado_venta;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = Database::getInstance();
    }

    #region GETTERS Y SETTERS
    public function __set($name, $value)
    {
        return $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
    #endregion

    #region CRUD
    public function crear_compra(){

    }

    public function listar_compra(){

    }

    public function actualizar_compra(){

    }

    public function eliminar_compra(){

    }
    #endregion
}