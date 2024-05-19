<?php

namespace models;

use config\Database;

class DetalleCompras
{
    private $id;
    private $cod_compra;
    private $isbn_libro;
    private $cantidad;
    private $total;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = Database::getInstance();
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

    // factura
    public function getCod_compra()
    {
        return $this->cod_compra;
    }

    public function setCod_compra($cod_compra)
    {
        $this->cod_compra = $cod_compra;

        return $this;
    }

    // libro
    public function getIsbn_libro()
    {
        return $this->isbn_libro;
    }

    public function setIsbn_libro($isbn_libro)
    {
        $this->isbn_libro = $isbn_libro;

        return $this;
    }

    // cantidad
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    // total
    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
    #endregion

    #region   CRUD
    public function crear_detalle_compra(){

    }

    public function listar_detalle_compra(){

    }

    public function actualizar_detalle_compra(){

    }

    public function eliminar_detalle_compra(){
        
    }
    #endregion
}
