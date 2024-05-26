<?php
namespace controllers;

use helpers\Utils;

use models\Libro;

class Carrito{ 
    public function index(){
        if(isset($_SESSION['cart'])){
            $carrito = $_SESSION['cart'];
        }
        require_once 'views/carrito/carrito.php';
    }

    public function add(){
        // verificar si existe el carrito
        if(isset($_GET['id'])){
            $id_libro = $_GET['id'];
        }else{
            header('Location: ' . base_url);
        }

        // si el carrito existe verificar si existe el articulo
        if(isset($_SESSION['cart'])){
            $contador = 0;

            foreach ($_SESSION['cart'] as $index => $value) {
                if($_SESSION['cart'][$index]['id_libro'] == $id_libro){
                    $contador++;
                    $_SESSION['cart'][$index]['unidades']++; 
                }
            }
        }

        // sino existe el articulo agregarlo
        if(!isset($contador) || $contador == 0){
            $libro = new Libro();
            $libro->__set('id', $id_libro);
            $book = $libro->getLibro();

            if($book){
                $_SESSION['cart'][] = [
                    "id_libro" => $book->id,
                    "precio" => $book->price,
                    "unidades" => 1,
                    "libro" => $book
                ];
            }
        }

        header('Location: ' . base_url . 'carrito/index');
    }

    public function eliminar(){
        if(isset($_SESSION['cart']) && isset($_GET['id'])){
            $id_carrito = $_GET['id'];

            unset($_SESSION['cart'][$id_carrito]);
        }
        header('Location: ' . base_url . 'carrito/');
    }

    public function vaciar(){
        Utils::eliminarSesion('cart');
        header('Location: ' . base_url . 'carrito/');
    }

    public function finalizar(){
        if(!isset($_SESSION['user'])){
            $_SESSION['action_error_cart'] = "Debe iniciar sesión para finalizar la compra";
        }

        if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
            $carrito = $_SESSION['cart'];
            require_once 'views/carrito/finalizar.php';
        }
    }
}