<?php
namespace controllers;

use helpers\Utils;

class Carrito{ 
    public function index(){
        if(isset($_SESSION['cart'])){
            $carrito = $_SESSION['cart'];
        }else{
            header('Location: ' . base_url);
        }
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
                    $_SESSION['cart'][$index]['cantidad']++; 
                }
            }
        }

        // sino existe el articulo agregarlo
        
    }

    public function vaciarCarrito(){
        Utils::eliminarSesion('cart');
    }
}