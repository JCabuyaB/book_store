<?php

namespace controllers;

use models\Compra_detalle;

use helpers\Utils;
use Exception;

class Compra{
    public function index(){
        if(isset($_POST) && isset($_SESSION['user']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
            $pedido = new Compra_detalle();
            $id_user = $_SESSION['user']->id;
            try{
                // datos de la compra
                $pedido->__set('id_usuario', $id_user);
                $compra = $pedido->insert_all_bill();

                if(!$compra){
                    $_SESSION['action_error'] = "No se creó el pedido";
                    header('Location: ' . base_url . 'carrito/finalizar');
                }else{
                    unset($_SESSION['cart']);
                }

            }catch(Exception $e){
                $_SESSION['action_error'] = "Sucedió un error durante la operación: " . $e;
            }
        }else{
            $_SESSION['action_error'] = "No se completó la petición";
        }
        header('Location: ' . base_url . 'compra/compras');
    }

    public function compras(){
        Utils::validarLogin();
        $compra = new Compra_detalle();
        if(isset($_SESSION['user']) && isset($_SESSION['admin'])){
            $pedidos = $compra->getAll();
        }elseif(isset($_SESSION['user']) && !isset($_SESSION['admin'])){
            $id_user = $_SESSION['user']->id;
            $compra->__set('id_usuario', $id_user);
            $pedidos = $compra->getOneUser();
        }
        require_once 'views/compra/compras.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id_pedido = $_GET['id'];
            $pedido = new Compra_detalle();
            $pedido->__set('cod_compra', $id_pedido);
            $libros = $pedido->getDetail();

            require_once 'views/compra/compra.php';
        }else{
            header('Location: ' . base_url);
        }
    }

    public function actualizar(){
        if(isset($_GET['id'])){
            $id_pedido = $_GET['id'];
            $pedido = new Compra_detalle();
            $pedido->__set('cod_compra', $id_pedido);

            $estado = $pedido->selectStatus(); 

            require_once 'views/compra/actualizar.php';
        }else{
            header('Location: ' . base_url . 'compra/compras');
        }
    }

    public function actualizar_estado(){
        if(isset($_POST)){
            $id_compra = isset($_POST['id']) ? $_POST['id'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;

            if(!empty($id_compra) && is_numeric($id_compra) && !empty($estado)){
                $compra = new Compra_detalle();
                $compra->__set('codigo', $id_compra);
                $compra->__set('estado_venta', $estado);

                $update = $compra->updateStatus();

                if($update){
                    $_SESSION['action_status']['success'] = "Se actualizó el estado";
                }else{
                    $_SESSION['action_status']['failed'] = "No se actualizó el estado";
                }
            }
        }
        header('Location: ' . base_url . 'compra/compras');
    }
}