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
    // codigo factura
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    // usuario 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    // fecha
    public function getFecha_venta()
    {
        return $this->fecha_venta;
    }

    public function setFecha_venta($fecha_venta)
    {
        $this->fecha_venta = $fecha_venta;

        return $this;
    }

    // estado
    public function getEstado_venta()
    {
        return $this->estado_venta;
    }

    public function setEstado_venta($estado_venta)
    {
        $this->estado_venta = $estado_venta;

        return $this;
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