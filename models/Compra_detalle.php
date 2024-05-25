<?php

namespace models;

use config\Database;
use Exception;

class Compra_detalle
{
    // compra
    private $codigo;
    private $id_usuario;
    private $fecha_venta;
    private $estado_venta;

    // detalle
    private $id;
    private $cod_compra;
    private $id_libro;
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

    #region crear compra
    public function crear_compra($conn)
    {
        $query = "INSERT INTO tbl_compras VALUES(null, {$this->__get('id_usuario')}, CURDATE(), 'Por confirmar');";

        $insertar = $conn->query($query);

        $result = false;
        if($insertar && $conn->affected_rows > 0){
            $result = true;
        }

        return $result;
    }

    public function crear_detalle_compra($conn)
    {
        // id del ultimo registro insertado
        $id_pedido = $conn->insert_id;

        $query = "INSERT INTO tbl_detalle_compras VALUES(null, {$id_pedido}, {$this->__get('id_libro')}, {$this->__get('cantidad')}, {$this->__get('total')});";
        $insertar = $conn->query($query);

        $result = false;

        if($insertar && $conn->affected_rows > 0){
            $result = true;
        }
        return $result;
    }

    public function insert_all_bill()
    {
        $result = false;
        // conexion
        $connection =$this->base_datos->getConnection();

        //iniciar transaccion
        $connection->begin_transaction();
        try{
            // id usuario se asigna en el controlador
            $compra = $this->crear_compra($connection);

            if(!$compra){
                throw new Exception("Error al crear el pedido");
                
            }

            //insertar el detalle de la compra/pedido
            foreach ($_SESSION['cart'] as $index => $valor) {
                $total = $_SESSION['cart'][$index]['unidades'] * $_SESSION['cart'][$index]['precio'];

                $this->__set('id_libro', $_SESSION['cart'][$index]['id_libro']);
                $this->__set('cantidad', $_SESSION['cart'][$index]['unidades']);
                $this->__set('total', $total);

                $detalle_result = $this->crear_detalle_compra($connection);
                if(!$detalle_result){
                    throw new Exception("Error al crear el detalle del pedido");
                }
            }

            //confirmar transaccion
            $connection->commit();
            $result = true;
        }catch(Exception $e){
            $connection->rollback(); // revertir transaccion en caso de error
            throw new Exception("Error al procesar la solicitud: " . $e->getMessage());
        }

        return $result;
    }
    #endregion

    #region select
    public function getAll(){
        $query = "SELECT c.cod, c.sale_date, c.sale_state, u.name, COUNT(d.id) as libros, SUM(d.total) total FROM tbl_compras c INNER JOIN tbl_usuarios u ON u.id = c.id_user INNER JOIN tbl_detalle_compras d ON c.cod = d.cod_bill GROUP BY c.cod, c.sale_state, u.name ORDER BY c.cod DESC;";

        $connection = $this->base_datos->getConnection();
        $select = $connection->query($query);

        $result = false;
        if($select && $select->num_rows > 0){
            $result = $select;
        }

        return $result;
    }

    public function getOneUser(){
        $query = "SELECT c.cod, c.sale_date, c.sale_state, u.name, COUNT(d.id) as libros, SUM(d.total) total FROM tbl_compras c INNER JOIN tbl_usuarios u ON u.id = c.id_user INNER JOIN tbl_detalle_compras d ON c.cod = d.cod_bill WHERE u.id = {$this->__get('id_usuario')} GROUP BY c.cod, c.sale_state, u.name ORDER BY c.cod DESC;";

        $connection = $this->base_datos->getConnection();
        $select = $connection->query($query);

        $result = false;
        if($select && $select->num_rows > 0){
            $result = $select;
        }

        return $result;
    }

    public function getDetail(){
        $query = "SELECT l.*, c.category_name, d.quantity, (l.price * d.quantity) subtotal, SUM(d.total) total FROM tbl_libros l INNER JOIN tbl_detalle_compras d ON d.id_book = l.id INNER JOIN tbl_categorias c ON c.id = l.id_cat WHERE d.cod_bill = {$this->__get('cod_compra')} GROUP BY d.id_book, subtotal, total;";

        $connection = $this->base_datos->getConnection();
        $pedido = $connection->query($query);

        return $pedido;
    }


    public function selectStatus(){
        $query = "SELECT cod, sale_state FROM tbl_compras WHERE  cod = {$this->__get('cod_compra')};";

        $connection = $this->base_datos->getConnection();
        $pedido = $connection->query($query);

        return $pedido->fetch_object();
    }
    #endregion

    #region update estado
    public function updateStatus(){
        $query = "UPDATE tbl_compras SET sale_state = '{$this->__get('estado_venta')}' WHERE cod = {$this->__get('codigo')};";

        $connection = $this->base_datos->getConnection();
        $update = $connection->query($query);

        $result = false;
        if($update && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    }
    #endregion
}
