<?php
namespace controllers;

class Libro{
    public function index(){
        require_once 'views/libro/libros.php';
    }

    public function administrar(){
        require_once 'views/libro/formulario_libro.php';
    }

    public function crear(){
        
    }

    public function editar(){

    }
}