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
    public function __set($name, $value)
    {
        return $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
    #endregion

    #region   CRUD
    public function crear_detalle_compra(){

    }

    public function listar_detalle_compra(){

    }

    public function actualizar_detalle_compra(){{}

    }

    public function eliminar_detalle_compra(){
        
    }
    #endregion
}
